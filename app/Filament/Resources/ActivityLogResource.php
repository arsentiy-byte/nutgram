<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages\ListActivityLogs;
use App\Filament\Resources\ActivityLogResource\Pages\ViewActivityLog;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;

final class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    /**
     * @return string|null
     */
    public static function getNavigationGroup(): ?string
    {
        return __('filament::layout.menu.settings');
    }

    /**
     * @return string|null
     */
    public static function getLabel(): ?string
    {
        return __('filament::pages/activities.title');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('filament::pages/activities.title');
    }

    /**
     * @return string|null
     */
    public static function getPluralLabel(): ?string
    {
        return __('filament::pages/activities.plural_title');
    }

    /**
     * @param Infolist $infolist
     * @return Infolist
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('causer.log_panel_name')
                            ->label(__('filament::resources/pages/form-element.causer'))
                            ->badge()
                            ->url(fn (Activity $record) => UserResource::getUrl('edit', ['record' => $record->causer_id])),
                        TextEntry::make('subject.log_panel_name')
                            ->label(__('filament::resources/pages/form-element.subject'))
                            ->default('-'),
                        TextEntry::make('description')
                            ->label(__('filament::resources/pages/form-element.description')),
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Section::make()
                    ->schema([
                        TextEntry::make('log_name')
                            ->label(__('filament::resources/pages/form-element.type')),
                        TextEntry::make('event')
                            ->label(__('filament::resources/pages/form-element.event')),
                        TextEntry::make('created_at')
                            ->label(__('filament::resources/pages/form-element.date')),
                    ])
                    ->columns([
                        'sm' => 1,
                    ])
                    ->columnSpan([
                        'sm' => 1,
                    ]),
                Section::make(__('filament::resources/pages/form-element.properties'))
                    ->schema([
                        KeyValueEntry::make('properties')
                            ->label('')
                            ->hidden(function (Activity $record) {
                                return null !== $record->properties
                                    && $record->properties->has('attributes')
                                    && $record->properties->has('old');
                            }),
                        KeyValueEntry::make('properties.attributes')
                            ->label(__('filament::resources/pages/form-element.new_values'))
                            ->hidden(fn (Activity $record) => null !== $record->properties && ! $record->properties->has('attributes')),
                        KeyValueEntry::make('properties.old')
                            ->label(__('filament::resources/pages/form-element.old_values'))
                            ->hidden(fn (Activity $record) => null !== $record->properties && ! $record->properties->has('old')),
                    ]),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListActivityLogs::route('/'),
            'view' => ViewActivityLog::route('/{record}'),
        ];
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('log_name')
                    ->label(__('filament::resources/pages/form-element.type'))
                    ->badge(),
                TextColumn::make('event')
                    ->label(__('filament::resources/pages/form-element.event')),
                TextColumn::make('subject.log_panel_name')
                    ->label(__('filament::resources/pages/form-element.subject'))
                    ->default('-'),
                TextColumn::make('subject.log_subject_type')
                    ->label(__('filament::resources/pages/form-element.subject_type')),
                TextColumn::make('causer.log_panel_name')
                    ->label(__('filament::resources/pages/form-element.causer'))
                    ->badge(),
                TextColumn::make('created_at')
                    ->label(__('filament::resources/pages/form-element.date')),
            ])
            ->actions([
                ViewAction::make(),
            ]);
    }
}
