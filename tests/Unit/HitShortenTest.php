<?php

namespace Tests\Unit;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Domain\Shorten\Events\ShortenHit;
use App\Domain\Shorten\ShortenAggregateRoot;
use App\Models\Shorten;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class HitShortenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_hit_shorten_event_is_dispatched()
    {
        $shorten = $this->emitShortenCreateEvent();

        ShortenAggregateRoot::fake()
            ->given(new ShortenHit($shorten->uuid))
            ->assertApplied(new ShortenHit($shorten->uuid));
    }

    /** @test */
    public function test_hit_shorten_event_with_max_hits_reached()
    {
        $shorten = $this->emitShortenCreateEvent([
            'hits'      => 123,
            'max_hits'  => 1000,
        ]);

        ShortenAggregateRoot::fake()
            ->when(function (ShortenAggregateRoot $shortenAggregate) use ($shorten) {
                $shortenAggregate->addHit($shorten->uuid)->persist();
            })->assertApplied(new ShortenHit($shorten->uuid));
    }

    /**
     * It emits a ShortenCreate event with specified attributes
     *
     * @param array $attributes
     * @return Shorten
     */
    private function emitShortenCreateEvent(array $attributes = []): Shorten
    {
        $attributes['uuid'] = Uuid::uuid4()->toString();

        $factory = Shorten::factory($attributes)->makeOne()->toArray();

        $event = new ShortenCreated($factory);

        event($event);

        return Shorten::uuid($attributes['uuid']);
    }
}
