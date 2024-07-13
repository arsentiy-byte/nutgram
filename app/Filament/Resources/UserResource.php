<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    /**
     * @return string|null
     */
    public static function getNavigationGroup(): ?string
    {
        return __('filament::layout.menu.settings');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('filament::pages/users.plural_title');
    }

    /**
     * @return string
     */
    public static function getLabel(): string
    {
        return __('filament::pages/users.title');
    }

    /**
     * @return string
     */
    public static function getPluralLabel(): string
    {
        return __('filament::pages/users.plural_title');
    }

    /**
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament::resources/pages/form-element.name'))
                            ->required()
                            ->columnSpan([
                                'sm' => 1,
                            ])
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label(__('filament::resources/pages/form-element.email'))
                            ->required()
                            ->columnSpan([
                                'sm' => 1,
                            ])
                            ->maxLength(255),

                        Forms\Components\Select::make('roles.name')
                            ->multiple()
                            ->label(__('filament::resources/pages/form-element.role'))
                            ->relationship('roles', 'name')
                            ->preload(),

                        Forms\Components\TextInput::make('password')
                            ->label(__('filament::resources/pages/form-element.password'))
                            ->password()
                            ->maxLength(255)
                            ->required()
                            ->dehydrateStateUsing(fn ($state) =>  Hash::make($state)),

                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament::resources/pages/form-element.is_active'))
                            ->default(true)
                            ->columnSpan([
                                'sm' => 1,
                            ])
                            ->required(),
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => fn (?User $record) => null === $record ? 3 : 2,
                    ]),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('filament::resources/pages/form-element.created_at'))
                            ->content(fn (?User $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label(__('filament::resources/pages/form-element.updated_at'))
                            ->content(fn (?User $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1)
                    ->hidden(fn (?User $record) => null === $record),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament::resources/pages/form-element.name')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament::resources/pages/form-element.email')),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('filament::resources/pages/form-element.role')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
