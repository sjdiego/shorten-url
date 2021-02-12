<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class Shorten
 * @method static create(array $shortenAttributes)
 * @package App\Models
 */
class Shorten extends Model
{
    use HasFactory;

    const SLUG_LEN = 5;

    public $fillable = ['uuid', 'url', 'slug', 'hits', 'max_hits', 'expires_at'];
    public $casts = ['expires_at' => 'date'];

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
     * @return static|null
     */
    public static function uuid(string $uuid): ?self
    {
        return static::where('uuid', $uuid)->first();
    }

    /**
     * @param string $slug
     * @return static|null
     */
    public static function slug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }
}
