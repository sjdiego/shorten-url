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
        )
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(["uuid", "code", "url", "hits", "max_hits", "expires_at"]);
    }

    /** @test */
    public function test_create_shorten_with_max_hits()
    {
        $maxHits = $this->faker->biasedNumberBetween(2, 1024);

        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['maxHits' => $maxHits])->makeOne()->toArray()
        )
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonFragment(["max_hits" => $maxHits])
            ->assertJsonStructure(["uuid", "code", "url", "hits", "max_hits", "expires_at"]);
    }


    /** @test */
    public function test_create_shorten_with_expiring_date()
    {
        $date = $this->faker->dateTimeThisMonth()->format('Y-m-d');

        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['expiresAt' => $date])->makeOne()->toArray()
        )
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonFragment(["expires_at" => $date])
            ->assertJsonStructure(["uuid", "code", "url", "hits", "max_hits", "expires_at"]);
    }

    /** @test */
    public function test_create_shorten_with_expiring_date_and_max_hits()
    {
        $date = $this->faker->dateTimeThisMonth()->format('Y-m-d');
        $maxHits = $this->faker->biasedNumberBetween(2, 1024);

        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['expiresAt' => $date, 'maxHits' => $maxHits])->makeOne()->toArray()
        )
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonFragment(["expires_at" => $date, 'max_hits' => $maxHits])
            ->assertJsonStructure(["uuid", "code", "url", "hits", "max_hits", "expires_at"]);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_incorrect_url()
    {
        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['url' => $this->faker->word])->makeOne()->toArray()
        )
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(["errors"]);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_invalid_expire_date()
    {
        $this->post(
            route('shorten.create'),
            [
                'url' => $this->faker->url,
                'expires_at' => $this->faker->biasedNumberBetween(0, 100),
            ]
        )
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(["errors"]);
    }

    /** @test */
    public function test_failure_on_create_shorten_with_missing_url()
    {
        $this->post(
            route('shorten.create'),
            ShortenFactory::new(['url' => null])->makeOne()->toArray()
        )
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(["errors"]);
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
        )
            ->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(["errors"]);
    }
}
