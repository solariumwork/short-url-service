<?php

namespace App\Services;

interface ShortUrlCachedServiceInterface
{
    public function getShortUrlCode(string $url);

    public function getLongUrl(string $code);

    public function cacheShortUrl(string $url, string $code): void;
}
