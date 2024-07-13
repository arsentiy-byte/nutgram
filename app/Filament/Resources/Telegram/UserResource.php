<?php

declare(strict_types=1);

namespace App\Filament\Resources\Telegram;

use App\Filament\Resources\Telegram\UserResource\ListUsers;
use App\Filament\Resources\Telegram\UserResource\ViewUser;
use App\Telegram\Models\User;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

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
        return __('filament::pages/telegram/users.title');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('filament::pages/telegram/users.plural_title');
    }

    /**
     * @return string|null
     */
    public static function getPluralLabel(): ?string
    {
        return __('filament::pages/telegram/users.plural_title');
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->label('ID'),
                TextColumn::make('username')
                    ->label(__('filament::resources/pages/form-element.username')),
                TextColumn::make('full_name')
                    ->label(__('filament::resources/pages/form-element.full_name')),
                TextColumn::make('created_at')
                    ->label(__('filament::resources/pages/form-element.created_at'))
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
                        TextEntry::make('user_id')
                            ->label(__('filament::resources/pages/form-element.user_id')),
                        TextEntry::make('username')
                            ->label(__('filament::resources/pages/form-element.username')),
                        TextEntry::make('full_name')
                            ->label(__('filament::resources/pages/form-element.full_name')),
                        TextEntry::make('created_at')
                            ->label(__('filament::resources/pages/form-element.created_at')),
                        TextEntry::make('updated_at')
                            ->label(__('filament::resources/pages/form-element.updated_at')),
                    ]),
                Section::make()
                    ->schema([
                        KeyValueEntry::make('data')
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
            'index' => ListUsers::route('/'),
            'view' => ViewUser::route('/{record}'),
        ];
    }
}
