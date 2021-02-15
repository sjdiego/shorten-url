<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'code' => $this->slug,
            'url' => $this->url,
            'hits' => $this->hits,
            'max_hits' => $this->max_hits,
            'expires_at' => $this->expires_at ? Carbon::parse($this->expires_at)->toDateString() : null,
        ];
    }
}
