<?php

namespace App\Repositories;

use App\Models\ShortUrl;

class ShortUrlRepository implements ShortUrlRepositoryInterface
{
    /**
     * @param string $url
     *
     * @return ShortUrl|null
     */
    public function firstByUrl(string $url): ?ShortUrl
    {
        return ShortUrl::where('url', '=', $url)
            ->first();
    }

    /**
     * @param string $code
     *
     * @return ShortUrl|null
     */
    public function firstByCode(string $code): ?ShortUrl
    {
        return ShortUrl::where('code', '=', $code)
            ->first();
    }

    /**
     * @param string $url
     * @param string $code
     *
     * @return ShortUrl
     */
    public function create(string $url, string $code): ShortUrl
    {
        return ShortUrl::create([
           'url' => $url,
           'code' => $code
        ]);
    }
}
