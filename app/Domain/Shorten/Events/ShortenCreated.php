<?php

namespace App\Domain\Shorten\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ShortenCreated extends ShouldBeStored
{
    public function __construct(public array $shortenAttributes) {}
}
