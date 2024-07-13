<?php

declare(strict_types=1);

namespace App\Filament\Resources\Telegram;

use AhmedAbdelaal\FilamentJsonPreview\JsonPreview;
use App\Filament\Resources\Telegram\MessageResource\ListMessages;
use App\Filament\Resources\Telegram\MessageResource\ViewMessage;
use App\Telegram\Models\Message;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

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
        return __('filament::pages/telegram/messages.title');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('filament::pages/telegram/messages.plural_title');
    }

    /**
     * @return string|null
     */
    public static function getPluralLabel(): ?string
    {
        return __('filament::pages/telegram/messages.plural_title');
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('message_id')
                    ->label('ID'),
                TextColumn::make('from.username')
                    ->badge()
                    ->label(__('filament::resources/pages/form-element.username')),
                TextColumn::make('chat_id')
                    ->badge()
                    ->label(__('filament::resources/pages/form-element.chat_id')),
                TextColumn::make('text')
                    ->limit(25)
                    ->label(__('filament::resources/pages/form-element.text')),
                TextColumn::make('date')
                    ->label(__('filament::resources/pages/form-element.date')),
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
                        TextEntry::make('message_id')
                            ->label(__('filament::resources/pages/form-element.message_id')),
                        TextEntry::make('from.username')
                            ->label(__('filament::resources/pages/form-element.username'))
                            ->badge()
                            ->hidden(fn (Message $record): bool => null === $record->from_id)
                            ->url(fn (Message $record) => UserResource::getUrl('view', ['record' => $record->from_id])),
                        TextEntry::make('chat_id')
                            ->label(__('filament::resources/pages/form-element.chat_id'))
                            ->badge()
                            ->hidden(fn (Message $record): bool => null === $record->chat_id)
                            ->url(fn (Message $record) => ChatResource::getUrl('view', ['record' => $record->chat_id])),
                        TextEntry::make('text')
                            ->label(__('filament::resources/pages/form-element.text')),
                        TextEntry::make('date')
                            ->label(__('filament::resources/pages/form-element.date')),
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
            'index' => ListMessages::route('/'),
            'view' => ViewMessage::route('/{record}'),
        ];
    }
}
