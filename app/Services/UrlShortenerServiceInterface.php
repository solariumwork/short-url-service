<?php

namespace App\Services;

interface UrlShortenerServiceInterface
{
    public function makeShorter(string $url);

    public function restoreUrlByCode(string $code);
}
