<?php

namespace App\Repositories;

use App\Models\ShortUrl;

interface ShortUrlRepositoryInterface
{
    public function firstByUrl(string $url): ?ShortUrl;

    public function firstByCode(string $code): ?ShortUrl;

    public function create(string $url, string $code): ShortUrl;
}
