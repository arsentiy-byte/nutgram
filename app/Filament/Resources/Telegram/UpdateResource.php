<?php

declare(strict_types=1);

namespace App\Filament\Resources\Telegram;

use AhmedAbdelaal\FilamentJsonPreview\JsonPreview;
use App\Filament\Resources\Telegram\UpdateResource\ListUpdates;
use App\Filament\Resources\Telegram\UpdateResource\ViewUpdate;
use App\Telegram\Models\Update;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class UpdateResource extends Resource
{
    protected static ?string $model = Update::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    /**
     * @return string|null
     */
    public static function getNavigationGroup(): ?string
    {
        return __('filament::layout.menu.telegram');
    }

    /**
     * @return string|null
     */
    public static function getLabel(): ?string
    {
        return __('filament::pages/telegram/updates.title');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('filament::pages/telegram/updates.plural_title');
    }

    /**
     * @return string|null
     */
    public static function getPluralLabel(): ?string
    {
        return __('filament::pages/telegram/updates.plural_title');
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('update_id')
                    ->label('ID'),
                TextColumn::make('created_at')
                    ->label(__('filament::resources/pages/form-element.created_at')),
            ])
            ->actions([
                ViewAction::make(),
            ]);
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
                        TextEntry::make('update_id')
                            ->label(__('filament::resources/pages/form-element.update_id')),
                        TextEntry::make('created_at')
                            ->label(__('filament::resources/pages/form-element.created_at')),
                        TextEntry::make('updated_at')
                            ->label(__('filament::resources/pages/form-element.updated_at')),
                    ]),
                Section::make()
                    ->schema([
                        JsonPreview::make('data')
                            ->label(__('filament::resources/pages/form-element.properties')),
                    ])
            ]);
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListUpdates::route('/'),
            'view' => ViewUpdate::route('/{record}'),
        ];
    }
}
