<?php

namespace App\Domain\Shorten;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Domain\Shorten\Events\ShortenHit;
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
        $this->recordThat(new ShortenHit($shortenUuid));

        return $this;
    }
}
