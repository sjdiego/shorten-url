<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortenFailedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'code' => $this->slug,
            'url' => false,
            'error' => 'The requested link has reached max hits or is expired',
        ];
    }
}
