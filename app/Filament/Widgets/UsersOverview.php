<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

final class UsersOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    /**
     * @return array<int, Stat>
     */
    protected function getCards(): array
    {
        $users = Trend::query(User::query())
            ->between(
                start: Carbon::now()->subWeek(),
                end: Carbon::now(),
            )
            ->perDay()
            ->count();

        return [
            Stat::make('Количество пользователей бота', User::query()->count())
                ->description('За все время')
                ->descriptionIcon('heroicon-s-user-group')
                ->icon('heroicon-s-user')
                ->chart($users->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color('success'),
        ];
    }
}
