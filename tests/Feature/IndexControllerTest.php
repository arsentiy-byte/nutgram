<?php

declare(strict_types=1);

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class IndexControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get('/api');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
