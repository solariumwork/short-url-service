<?php

namespace App\Services;

use App\Repositories\ShortUrlRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UrlShortenerService implements UrlShortenerServiceInterface
{
    private ShortUrlCachedServiceInterface $shortUrlCachedService;
    private ShortUrlRepositoryInterface $shortUrlRepository;
    private string $appUrl;

    /**
     * @param ShortUrlCachedServiceInterface $shortUrlCachedService
     * @param ShortUrlRepositoryInterface $shortUrlRepository
     */
    public function __construct(
        ShortUrlCachedServiceInterface $shortUrlCachedService,
        ShortUrlRepositoryInterface $shortUrlRepository
    ) {
        $this->shortUrlCachedService = $shortUrlCachedService;
        $this->shortUrlRepository = $shortUrlRepository;
        $this->appUrl = Config::get('app.url');
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function makeShorter(string $url): string
    {
        $cachedShortUrl = $this->shortUrlCachedService->getShortUrl($url);
        if ($cachedShortUrl !== null) {
            return $cachedShortUrl;
        }

        $shortUrl = $this->shortUrlRepository->firstByUrl($url);
        if ($shortUrl !== null) {
            return $this->getShortUrlByCode($shortUrl->code);
        }

        $code = uniqid();
        $this->shortUrlRepository->create($url, $code);
        $this->shortUrlCachedService->cacheUrl($url, $code);

        return $this->getShortUrlByCode($code);
    }

    /**
     * @param string $code
     *
     * @return string
     * @throws Exception
     */
    public function restoreUrlByCode(string $code): string
    {
        $cachedUrl = $this->shortUrlCachedService->getLongUrl($code);
        if ($cachedUrl !== null) {
            return $cachedUrl;
        }

        $url = $this->shortUrlRepository->firstByCode($code);
        if ($url !== null) {
            return $url->url;
        }

        throw new NotFoundHttpException('Короткая ссылка не найдена');
    }

    /**
     * @param string $code
     *
     * @return string
     */
    private function getShortUrlByCode(string $code): string
    {
        return $this->appUrl . '/' . $code;
    }
}
