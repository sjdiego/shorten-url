<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Database\Factories\ShortenFactory;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Tests\TestCase;

class HitShortenAPITest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_hit_valid_shorten()
    {
        $shorten = ShortenFactory::new(['uuid' => Str::uuid()->toString()])->create();

        $this
            ->get(route('shorten.check', $shorten->slug))
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(['uuid', 'code', 'url', 'hits', 'max_hits', 'expires_at'])
            ->assertJsonMissing(['error']);
    }

    /** @test */
    public function test_hit_invalid_shorten()
    {
        $this
            ->get(route('shorten.check', Str::random(12)))
            ->assertStatus(JsonResponse::HTTP_NOT_FOUND)
            ->assertJsonStructure(['error']);
    }

    /** @test */
    public function test_hit_with_max_hits_unreached_shorten()
    {
        $shorten = ShortenFactory::new([
            'uuid' => Str::uuid()->toString(),
            'hits' => 100,
            'max_hits' => 1000
        ])->create();

        $this
            ->get(route('shorten.check', $shorten->slug))
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(['uuid', 'code', 'url', 'hits', 'max_hits', 'expires_at'])
            ->assertJsonMissing(['error']);
    }

    /** @test */
    public function test_hit_with_max_hits_reached_shorten()
    {
        $shorten = ShortenFactory::new([
            'uuid' => Str::uuid()->toString(),
            'hits' => 100,
            'max_hits' => 10
        ])->create();

        $this
            ->get(route('shorten.check', $shorten->slug))
            ->assertStatus(JsonResponse::HTTP_FORBIDDEN)
            ->assertJsonStructure(['uuid', 'url', 'code', 'error']);
    }

    /** @test */
    public function test_hit_not_expired_shorten()
    {
        $shorten = ShortenFactory::new([
            'uuid' => Str::uuid()->toString(),
            'expires_at' => Carbon::tomorrow()->toDateTimeString()
        ])->create();

        $this
            ->get(route('shorten.check', $shorten->slug))
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure(['uuid', 'code', 'url', 'hits', 'max_hits', 'expires_at'])
            ->assertJsonMissing(['error']);
    }

    /** @test */
    public function test_hit_expired_shorten()
    {
        $shorten = ShortenFactory::new([
            'uuid' => Str::uuid()->toString(),
            'expires_at' => Carbon::yesterday()->toDateTimeString()
        ])->create();

        $this
            ->get(route('shorten.check', $shorten->slug))
            ->assertStatus(JsonResponse::HTTP_FORBIDDEN)
            ->assertJsonStructure(['uuid', 'url', 'code', 'error']);
    }
}
