<?php

namespace App\Domain\Shorten\Projectors;

use App\Domain\Shorten\Events\{ShortenHit, ShortenCreated};
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
            throw new DomainException($validator->errors()->toJson());
        }

        Shorten::create($event->shortenAttributes);
    }

    public function onShortenHit(ShortenHit $event)
    {
        $shorten = Shorten::uuid($event->shortenUuid);

        $shorten->hits++;

        $shorten->save();
    }
}
