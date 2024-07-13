<?php

declare(strict_types=1);

namespace App\Filament\Resources\Telegram\UpdateResource;

use App\Filament\Resources\Telegram\UpdateResource;
use Filament\Resources\Pages\ListRecords;

final class ListUpdates extends ListRecords
{
    protected static string $resource = UpdateResource::class;
}
