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
    public function getShortUrl(string $url)
    {
        return $this->redis->get(ShortUrlCachedServiceInterface::URL_KEY_PREFIX . ' ' . $url);
    }

    /**
     * @param string $code
     *
     * @return string
     */
    public function getLongUrl(string $code)
    {
        return $this->redis->get(ShortUrlCachedServiceInterface::CODE_KEY_PREFIX . ' ' . $code);
    }

    /**
     * @param string $url
     * @param string $code
     *
     * @return void
     */
    public function cacheUrl(string $url, string $code): void
    {
        $this->redis->set(ShortUrlCachedServiceInterface::URL_KEY_PREFIX . ' ' . $url, $code);
        $this->redis->set(ShortUrlCachedServiceInterface::CODE_KEY_PREFIX . ' ' . $code, $url);
    }
}
