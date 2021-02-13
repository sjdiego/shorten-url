<?php

namespace App\Models;

use App\Domain\Shorten\Events\ShortenHitExpired;
use App\Domain\Shorten\Events\ShortenHit;
use App\Domain\Shorten\Events\ShortenHitMaxReached;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Shorten
 *
 * @method static create(array $shortenAttributes)
 *
 * @property string uuid
 * @property string url
 * @property string slug
 * @property int hits
 * @property int max_hits
 * @property DateTime expires_at
 *
 * @package App\Models
 */
class Shorten extends Model
{
    use HasFactory;

    const SLUG_LEN = 5;

    public $fillable = ['uuid', 'url', 'slug', 'hits', 'max_hits', 'expires_at'];
    public $casts = ['hits' => 'int', 'max_hits' => 'int', 'expires_at' => 'date'];

    /**
     * @param int $chars
     * @return string
     */
    public static function generateUniqueSlug(int $chars = self::SLUG_LEN)
    {
        do {
            $slug = Str::random($chars);
        } while (self::whereSlug($slug)->count());

        return $slug;
    }

    /**
     * @param string $uuid
     * @return static
     */
    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function addHit(): bool
    {
        /**
         * Check if shortened link has reached max hits
         */
        if (!is_null($this->max_hits) &&
            ($this->hits >= $this->max_hits)
        ) {
            event(new ShortenHitMaxReached($this->uuid));
            return false;
        }

        /**
         * Check if shortened link has an expiring date
         */
        if (!is_null($this->expires_at) &&
            (Carbon::parse($this->expires_at)->isBefore(Carbon::now()))
        ) {
            event(new ShortenHitExpired($this->uuid));
            return false;
        }

        /**
         * Shortened link is not expired and not reached max hits
         */
        event(new ShortenHit($this->uuid));
        return true;
    }
}
