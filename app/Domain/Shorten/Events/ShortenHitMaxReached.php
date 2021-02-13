<?php

namespace App\Domain\Shorten\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ShortenHitMaxReached extends ShouldBeStored
{
    public function __construct(public string $shortenUuid) {}
}
