<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\StoreShortLinkRequest;
use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ShortLinkService
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return ShortLink::all();
    }

    /**
     * @param StoreShortLinkRequest $request
     */
    public function store(StoreShortLinkRequest $request): void
    {
        ShortLink::query()->create([
            'link' => $request->link,
            'code' => Str::random(8),
            'redirection_limit' => $request->redirection_limit === '0' ? null : $request->redirection_limit,
            'lifetime_limit' => $request->lifetime_limit,
        ]);
    }

    /**
     * @param string $code
     *
     * @return string|null
     */
    public function getShortLink(string $code): ?string
    {
        $shortLink = ShortLink::query()
            ->where('code', $code)
            ->where(function (Builder $query) {
                $query->where('redirection_limit', '>', 0)
                    ->orWhereNull('redirection_limit');
            })
            ->firstOrFail();

        $isExpired = $shortLink->created_at->addHour($shortLink->lifetime_limit) >= now();

        if ($isExpired) {
            $shortLink->decrement('redirection_limit');

            return $shortLink->link;
        } else {
            return null;
        }
    }
}
