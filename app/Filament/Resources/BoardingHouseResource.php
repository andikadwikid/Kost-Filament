<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Filament\Resources\BoardingHouseResource\RelationManagers;
use App\Models\BoardingHouse;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Informasi Utama')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->required()
                                    ->image()
                                    ->directory('boarding_houses'),
                                TextInput::make('name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('slug', str($state)->slug());
                                    }),
                                TextInput::make('slug')
                                    ->required()
                                    ->readOnly(),
                                Select::make('city_id')
                                    ->relationship('city', 'name')
                                    ->required(),
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required(),
                                RichEditor::make('description')
                                    ->required(),
                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->required(),
                                Textarea::make('address')
                                    ->required(),
                            ]),
                        Tabs\Tab::make('Bonus')
                            ->schema([
                                Repeater::make('bonuses')
                                    ->relationship('bonuses')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->required()
                                            ->image()
                                            ->directory('bonuses'),
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('description')
                                            ->required(),
                                    ])
                            ]),
                        Tabs\Tab::make('Room')
                            ->schema([
                                Repeater::make('rooms')
                                    ->relationship('rooms')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('room_type')
                                            ->required(),
                                        TextInput::make('square_feet')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('capacity')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('price_per_month')
                                            ->numeric()
                                            ->prefix('IDR')
                                            ->required(),
                                        Toggle::make('is_available')
                                            ->required(),
                                        Repeater::make('images')
                                            ->relationship('images')
                                            ->schema([
                                                FileUpload::make('image')
                                                    ->image()
                                                    ->directory('rooms')
                                                    ->required()
                                            ])
                                    ])
                            ]),
                    ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail'),
                TextColumn::make('name'),
                TextColumn::make('city.name'),
                TextColumn::make('category.name'),
                TextColumn::make('price'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
