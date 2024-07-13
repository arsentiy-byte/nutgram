<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Telegram\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class UsersChart extends ChartWidget
{
    public ?string $filter = 'week';

    protected static ?string $heading = 'Статистика пользователей';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '300px';

    /**
     * @var int|string|array<string, int | null>
     */
    protected int|string|array $columnSpan = 'full';

    /**
     * @return array{today: string, week: string, month: string, year: string}|null
     */
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Сегодня',
            'week' => 'Неделя',
            'month' => 'Месяц',
            'year' => 'Год',
        ];
    }

    /**
     * @return array{datasets: array{0: array{label: string, data: Collection, fill: false, borderColor: string, tension: float}}, labels: Collection}
     */
    protected function getData(): array
    {
        switch ($this->filter) {
            case 'today':
                {
                    $newUsers = $this->getNewUsersDay();
                    break;
                }
            case 'week':
                {
                    $newUsers = $this->getNewUsersWeek();
                    break;
                }
            case 'month':
                {
                    $newUsers = $this->getNewUsersMonth();
                    break;
                }
            case 'year':
            default:
                {
                    $newUsers = $this->getNewUsersYear();
                    break;
                }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Новых пользователей',
                    'data' => $newUsers->map(fn (TrendValue $value) => $value->aggregate),
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1,
                ],
            ],
            'labels' => $newUsers->map(fn (TrendValue $value) => $value->date),
        ];
    }

    /**
     * @return string
     */
    protected function getType(): string
    {
        return 'line';
    }

    /**
     * @return Collection
     */
    private function getNewUsersDay(): Collection
    {
        return Trend::query(User::query())
            ->between(
                start: Carbon::now()->subHours(24),
                end: Carbon::now(),
            )
            ->perHour()
            ->count();
    }

    /**
     * @return Collection
     */
    private function getNewUsersWeek(): Collection
    {
        return Trend::query(User::query())
            ->between(
                start: Carbon::now()->subWeek(),
                end: Carbon::now(),
            )
            ->perDay()
            ->count();
    }

    /**
     * @return Collection
     */
    private function getNewUsersMonth(): Collection
    {
        return Trend::query(User::query())
            ->between(
                start: Carbon::now()->subMonth(),
                end: Carbon::now(),
            )
            ->perDay()
            ->count();
    }

    /**
     * @return Collection
     */
    private function getNewUsersYear(): Collection
    {
        return Trend::query(User::query())
            ->between(
                start: Carbon::now()->subYear(),
                end: Carbon::now(),
            )
            ->perMonth()
            ->count();
    }
}
