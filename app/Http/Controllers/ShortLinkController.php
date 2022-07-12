<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortLinkRequest;
use App\Models\ShortLink;
use App\Service\ShortLinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ShortLinkController extends Controller
{
    /**
     * ShortLinkController constructor.
     * @param ShortLinkService $shortLinkService
     */
    public function __construct(private ShortLinkService $shortLinkService)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $shortLinks = $this->shortLinkService->index();

        return view('shortener.index', compact('shortLinks'));
    }

    /**
     * @param StoreShortLinkRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreShortLinkRequest $request): RedirectResponse
    {
        $this->shortLinkService->store($request);

        return redirect()
            ->route('shortener.index')
            ->with('success', 'Short link generated successfully!');
    }

    /**
     * @param string $code
     *
     * @return RedirectResponse
     */
    public function link(string $code): RedirectResponse
    {
        if ($shortLink = $this->shortLinkService->getShortLink($code)) {
            return redirect($shortLink);
        } else {
            abort(404);
        }
    }
}
