<?php

namespace App\Services;

interface ShortUrlCachedServiceInterface
{
    public const CODE_KEY_PREFIX = 'code';
    public const URL_KEY_PREFIX = 'url';

    public function getShortUrl(string $url);

    public function getLongUrl(string $code);

    public function cacheUrl(string $url, string $code): void;
}
