<?php

declare(strict_types=1);

namespace App\Filament\Resources\Telegram\ChatResource;

use App\Filament\Resources\Telegram\ChatResource;
use Filament\Resources\Pages\ListRecords;

final class ListChats extends ListRecords
{
    protected static string $resource = ChatResource::class;
}
