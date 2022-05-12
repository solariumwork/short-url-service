<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateShortUrlRequest;
use App\Services\UrlShortenerServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ShortUrlController extends Controller
{
    private UrlShortenerServiceInterface $urlShortenerService;

    /**
     * @param UrlShortenerServiceInterface $urlShortenerService
     */
    public function __construct(UrlShortenerServiceInterface $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    /**
     * @param GenerateShortUrlRequest $request
     *
     * @return JsonResponse
     */
    public function generate(GenerateShortUrlRequest $request): JsonResponse
    {
        $url = strip_tags(htmlspecialchars_decode($request->string('url')->trim()));

        $shortUrl = $this->urlShortenerService->makeShorter($url);

        return response()
            ->json([
                'url' => $url,
                'short_url' => $shortUrl
            ]);
    }

    /**
     * @param string $code
     * @return RedirectResponse
     */
    public function redirectByCode(string $code): RedirectResponse
    {
        if (trim($code) === '') {
            abort(404, 'Короткая ссылка не найдена');
        }

        $url = $this->urlShortenerService->restoreUrlByCode($code);

        return redirect()->to($url, Response::HTTP_MOVED_PERMANENTLY);
    }
}
