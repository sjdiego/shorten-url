<?php

namespace App\Domain\Shorten\Projectors;

use App\Domain\Shorten\Events\ShortenCreated;
use App\Models\Shorten;
use DomainException;
use Illuminate\Support\Facades\Validator;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ShortenProjector extends Projector
{
    public function onShortenCreated(ShortenCreated $event)
    {
        $validator = Validator::make($event->shortenAttributes, [
            'url' => 'required|url',
            'slug' => 'required|unique:shortens,slug',
            'hits' => 'integer',
            'max_hits' => 'integer',
            'expires_at' => 'date'
        ]);

        if ($validator->fails()) {
            throw new DomainException();
        }

        Shorten::create($event->shortenAttributes);
    }
}
