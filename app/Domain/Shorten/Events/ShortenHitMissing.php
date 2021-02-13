<?php

namespace App\Domain\Shorten\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ShortenHitMissing extends ShouldBeStored
{
    public function __construct(public string $shortenUuid) {}
}
