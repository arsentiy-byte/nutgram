<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Traits\ConfigTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;

final class LocalizationMiddleware
{
    use ConfigTrait;

    /**
     * Handle request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     *
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (in_array($locale = $request->headers->get('Accept-Language'), $this->getAvailableLocales(), true)) {
            $this->setCurrentLocale($locale);
        } else {
            $this->setCurrentLocale($this->getCurrentLocale());
        }

        return $next($request);
    }
}
