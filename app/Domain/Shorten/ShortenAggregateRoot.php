<?php

namespace App\Domain\Shorten;

use DomainException;
use App\Domain\Shorten\Events\ShortenCreated;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($attributes, [
            'url' => 'required|url',
            'slug' => 'required|unique:shortens,slug',
            'hits' => 'integer',
            'max_hits' => 'integer',
            'expires_at' => 'date'
        ]);

        if ($validator->fails()) {
            throw new DomainException();
        }

        $this->recordThat(new ShortenCreated($attributes));

        return $this;
    }
}
