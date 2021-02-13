<?php

namespace App\Domain\Shorten;

use App\Domain\Shorten\Events\{ShortenCreated, ShortenHit, ShortenHitExpired, ShortenHitMaxReached};
use App\Models\Shorten;
use Illuminate\Support\Facades\Event;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

/**
 * Class ShortenAggregateRoot
 * @method function createShorten()
 * @throw DomainException
 * @package App\Domain\Shorten
 */
class ShortenAggregateRoot extends AggregateRoot
{
    public function createShorten(array $attributes): ShortenAggregateRoot
    {
        $this->recordThat(new ShortenCreated($attributes));

        return $this;
    }

    public function addHit(string $shortenUuid): ShortenAggregateRoot
    {
        Event::listen([
            ShortenHit::class,
            ShortenHitExpired::class,
            ShortenHitMaxReached::class,
        ], function ($event) {
            $this->recordThat($event);
        });

        Shorten::uuid($shortenUuid)->addHit();

        return $this;
    }
}
