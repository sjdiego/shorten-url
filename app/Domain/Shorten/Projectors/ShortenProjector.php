<?php

namespace App\Domain\Shorten\Projectors;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Models\Shorten;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ShortenProjector extends Projector
{
    public function onShortenCreated(ShortenCreated $event)
    {
        Shorten::create($event->shortenAttributes);
    }
}
