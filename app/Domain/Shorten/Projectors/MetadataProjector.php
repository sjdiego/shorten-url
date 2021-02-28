<?php

namespace App\Domain\Shorten\Projectors;

use App\Domain\Shorten\Events\{ShortenCreated, ShortenHit, ShortenHitExpired, ShortenHitMaxReached, ShortenHitMissing};
use Ramsey\Uuid\Uuid;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\Facades\Projectionist;
use Spatie\EventSourcing\StoredEvents\Repositories\StoredEventRepository;
use Spatie\EventSourcing\StoredEvents\StoredEvent;

class MetadataProjector extends Projector
{
    public array $handlesEvents = [
        ShortenCreated::class => 'addSourceIp',
        ShortenHit::class => 'addSourceIp',
        ShortenHitMissing::class => 'addSourceIp',
        ShortenHitExpired::class => 'addSourceIp',
        ShortenHitMaxReached::class => 'addSourceIp',
    ];

    public function addSourceIp(StoredEvent $storedEvent, StoredEventRepository $repository)
    {
        if (!Projectionist::isReplaying()) {
            $storedEvent->meta_data = [
                'url' => request()->getRequestUri(),
                'method' => request()->getMethod(),
                'source_ip' => request()->getClientIp(),
                'useragent' => request()->userAgent(),
                'body' => request()->all(),
            ];

            $storedEvent->aggregate_uuid = strlen($storedEvent->aggregate_uuid) > 0 ?: Uuid::uuid4()->toString();

            $repository->update($storedEvent);
        }
    }
}
