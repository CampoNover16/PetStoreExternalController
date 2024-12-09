<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class PetControllerTest extends TestCase
{
    public function test_if_delete_pet_func_successfully_works()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/1' => Http::response([], 200), 
        ]);

        $response = $this->delete(route('pets.delete', ['id' => 1]));
        $response->assertRedirect(route('pets.index'));
    }

    public function test_if_shows_error_when_api_fails_to_fetch_pet()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet/*' => Http::response([], 404)
        ]);

        $response = $this->get(route('pets.find', ['petId' => 10]));
        $response->assertSessionHasErrors('error');
        $response->assertRedirect();
    }

    public function test_if_store_func_handles_failed_api_request()
    {
        Http::fake([
            'https://petstore.swagger.io/v2/pet' => Http::response([], 500),
        ]);

        $response = $this->post(route('pets.store'), [
            'name' => 'test',
            'photourl' => 'https://test.com/test.jpg',
            'category' => 'Cat',
            'tags' => ['tag1', 'tag2'],
            'status' => 'available',
        ]);
        $response->assertSessionHasErrors(['error']);
        $response->assertRedirect(route('pets.index'));
    }
}
