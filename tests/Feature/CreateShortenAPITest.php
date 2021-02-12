<?php

namespace Tests\Feature;

use Database\Factories\ShortenFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class CreateShortenAPITest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function test_create_shorten_endpoint_success()
    {
        $this->post(
            route('shorten.create'),
            ShortenFactory::new()->makeOne()->toArray()
        )->assertStatus(JsonResponse::HTTP_OK);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_incorrect_url()
    {
        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['url' => $this->faker->word])->makeOne()->toArray()
        )->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_invalid_expire_data()
    {
        $this->post(
            route('shorten.create'),
            [
                'url' => $this->faker->url,
                'expires_at' => 12,
            ]
        )->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_missing_url()
    {
        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['url' => null])->makeOne()->toArray()
        )->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_invalid_method()
    {
        $this->get(
            route('shorten.create'),
            ShortenFactory::new()->makeOne()->toArray()
        )->assertStatus(JsonResponse::HTTP_METHOD_NOT_ALLOWED);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_random_data()
    {
        $this->post(
            route('shorten.create'),
            [
                'id' => 1,
                'status' => $this->faker->boolean(),
                'sentences' => $this->faker->paragraphs(),
                'email' => $this->faker->freeEmail
            ]
        )->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
