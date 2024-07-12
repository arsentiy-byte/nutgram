<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait ConfigTrait
{
    protected function isTestingEnvironment(): bool
    {
        return (bool) App::environment('testing');
    }

    protected function isProductionEnvironment(): bool
    {
        return App::isProduction();
    }

    protected function isDevelopmentEnvironment(): bool
    {
        return (bool) App::environment('development');
    }

    protected function getEnvironment(): bool|string
    {
        return App::environment();
    }
}
