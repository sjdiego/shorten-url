<?php

namespace App\Domain\Shorten;

use App\Domain\Shorten\Events\ShortenCreated;
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


        return $this;
    }
}
