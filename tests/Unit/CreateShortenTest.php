<?php

namespace Tests\Unit;

use DomainException;
use App\Domain\Shorten\Events\ShortenCreated;
use App\Domain\Shorten\ShortenAggregateRoot;
use App\Models\Shorten;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateShortenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_created_shorten_event_is_dispatched()
    {
        $event = new ShortenCreated(
            Shorten::factory([
                'uuid' => Uuid::uuid4()->toString()
            ])->makeOne()->toArray()
        );

        Event::fake()->dispatch($event);

        Event::assertDispatched(ShortenCreated::class);
    }

    /** @test */
    public function test_created_shorten_event_is_applied()
    {
        $event = new ShortenCreated(
            Shorten::factory([
                'uuid' => Uuid::uuid4()->toString()
            ])->makeOne()->toArray()
        );

        ShortenAggregateRoot::fake()
            ->when(function (ShortenAggregateRoot $shortenAggregate) use ($event) {
                $shortenAggregate->createShorten($event->shortenAttributes)->persist();
            })
            ->assertApplied($event);
    }

    /** @test */
    public function test_failure_on_created_shorten_with_empty_url()
    {
        $event = new ShortenCreated(
            Shorten::factory([
                'uuid' => Uuid::uuid4()->toString(),
                'url' => '',
            ])->makeOne()->toArray()
        );

        $this->expectException(DomainException::class);

        ShortenAggregateRoot::fake()
            ->when(function (ShortenAggregateRoot $shortenAggregate) use ($event) {
                $shortenAggregate->createShorten($event->shortenAttributes)->persist();
            });
    }

    /** @test */
    public function test_failure_on_created_shorten_with_invalid_url()
    {
        $event = new ShortenCreated(
            Shorten::factory([
                'uuid' => Uuid::uuid4()->toString(),
                'url' => Str::random(20),
            ])->makeOne()->toArray()
        );

        $this->expectException(DomainException::class);

        ShortenAggregateRoot::fake()
            ->when(function (ShortenAggregateRoot $shortenAggregate) use ($event) {
                $shortenAggregate->createShorten($event->shortenAttributes)->persist();
            });
    }

    /** @test */
    public function test_failure_on_created_shorten_with_duplicated_slug()
    {
        $slug = 'AbCdE';

        $first = new ShortenCreated(
            Shorten::factory(['uuid' => Uuid::uuid4()->toString(), 'slug' => $slug])
                ->makeOne()
                ->toArray()
        );

        $duplicated = new ShortenCreated(
            Shorten::factory(['uuid' => Uuid::uuid4()->toString(), 'slug' => $slug])
                ->makeOne()
                ->toArray()
        );

        $this->expectException(DomainException::class);

        ShortenAggregateRoot::fake()
            ->when(function (ShortenAggregateRoot $shortenAggregate) use ($first, $duplicated) {
                $shortenAggregate->createShorten($first->shortenAttributes)->persist();
                $shortenAggregate->createShorten($duplicated->shortenAttributes)->persist();
            });

        $this->expectException(QueryException::class);

        ShortenAggregateRoot::fake()
            ->when(function (ShortenAggregateRoot $shortenAggregate) use ($first, $duplicated) {
                $shortenAggregate->createShorten($first->shortenAttributes);
                $shortenAggregate->createShorten($duplicated->shortenAttributes);
            })->persist();
    }
}
