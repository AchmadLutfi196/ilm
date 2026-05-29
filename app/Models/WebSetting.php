<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class WebSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember('web_settings_all', now()->addMinutes(60), function () {
            return self::pluck('value', 'key')->all();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set (upsert) a setting value by key and flush the cache.
     */
    public static function set(string $key, mixed $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('web_settings_all');
    }

    /**
     * Get all settings as an associative array (key => value).
     * Uses cache.
     */
    public static function all_cached(): array
    {
        return Cache::remember('web_settings_all', now()->addMinutes(60), function () {
            return self::pluck('value', 'key')->all();
        });
    }

    /**
     * Flush the web settings cache.
     */
    public static function flushCache(): void
    {
        Cache::forget('web_settings_all');
    }
}
