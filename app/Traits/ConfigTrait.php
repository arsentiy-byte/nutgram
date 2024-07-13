<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait ConfigTrait
{
    /**
     * @return bool
     */
    protected function isTestingEnvironment(): bool
    {
        return (bool) App::environment('testing');
    }

    /**
     * @return bool
     */
    protected function isProductionEnvironment(): bool
    {
        return App::isProduction();
    }

    /**
     * @return bool
     */
    protected function isDevelopmentEnvironment(): bool
    {
        return (bool) App::environment('development');
    }

    /**
     * @return bool|string
     */
    protected function getEnvironment(): bool|string
    {
        return App::environment();
    }

    /**
     * @return array<string, string>
     */
    protected function getAvailableLocales(): array
    {
        return config('app.available_locales', []);
    }

    /**
     * @param string $locale
     * @return void
     */
    protected function setCurrentLocale(string $locale): void
    {
        App::setLocale($locale);
    }

    /**
     * @return string
     */
    protected function getCurrentLocale(): string
    {
        return App::getLocale();
    }
}
