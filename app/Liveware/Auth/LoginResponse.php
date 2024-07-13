<?php

declare(strict_types=1);

namespace App\Liveware\Auth;

use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

final class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    /**
     * @param $request
     * @return RedirectResponse|Redirector
     */
    public function toResponse($request): RedirectResponse|Redirector
    {
        activity()
            ->useLog('Access')
            ->setEvent('login')
            ->causedBy($request->user())
            ->withProperties([
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])
            ->log('logged in');

        return parent::toResponse($request);
    }
}
