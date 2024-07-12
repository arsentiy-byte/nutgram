<?php

declare(strict_types=1);

namespace Tests;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Testing\FakeNutgram;

abstract class BotTestCase extends TestCase
{
    protected FakeNutgram $bot;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bot = $this->app->make(Nutgram::class);

        $this->bot
            ->hearText('/start')
            ->reply();
    }
}
