<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SergiX44\Nutgram\Nutgram;

final class TelegramController extends Controller
{
    /**
     * Handle the telegram webhook request.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(Nutgram $bot): void
    {
        $bot->run();
    }
}
