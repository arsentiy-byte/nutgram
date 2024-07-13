<?php

declare(strict_types=1);

namespace App\Filament\Resources\Telegram\MessageResource;

use App\Filament\Resources\Telegram\MessageResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;
}
