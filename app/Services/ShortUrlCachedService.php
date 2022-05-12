<?php

namespace App\Services;

use Illuminate\Contracts\Redis\Factory;

class ShortUrlCachedService implements ShortUrlCachedServiceInterface
{
    private Factory $redis;

    /**
     * @param Factory $redis
     */
    public function __construct(Factory $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function getShortUrlCode(string $url)
    {
        return $this->redis->get($url);
    }

    /**
     * @param string $code
     *
     * @return string
     */
    public function getLongUrl(string $code)
    {
        return $this->redis->get($code);
    }

    /**
     * @param string $url
     * @param string $code
     *
     * @return void
     */
    public function cacheShortUrl(string $url, string $code): void
    {
        $this->redis->set($url, $code);
        $this->redis->set($code, $url);
    }
}
