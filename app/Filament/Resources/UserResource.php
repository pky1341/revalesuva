<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(25),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->required()
                    ->preload()
                    ->reactive()
                    ->searchable(),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'male',
                        'female' => 'female',
                    ])->required(),
                Forms\Components\TextInput::make('contact_number')
                    ->tel(),

                Forms\Components\TextInput::make('height')
                    ->numeric()
                    ->maxLength(10),

                Forms\Components\TextInput::make('initial_weight')
                    ->numeric()
                    ->maxLength(10),

                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->maxLength(3),

                Forms\Components\Select::make('regular_period')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ]),
                Forms\Components\DatePicker::make('date_of_last_period'),

                Forms\Components\TextInput::make('number_of_cycle_days')
                    ->numeric()
                    ->maxLength(3),

                Forms\Components\TextInput::make('street')
                    ->maxLength(255),
                Forms\Components\TextInput::make('house')
                    ->maxLength(255),
                Forms\Components\TextInput::make('apartment')
                    ->maxLength(255),

                Forms\Components\TextInput::make('zipcode')
                    ->integer(true)
                    ->maxLength(255),
                Forms\Components\Select::make('city')
                    ->options([
                        'surat' => 'surat',
                    ]),
                Forms\Components\Select::make('personal_status')
                    ->options([
                        'married' => 'married',
                        'unmarried'=> 'unmarried',
                    ]),
                Forms\Components\TextInput::make('occupation')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options(
                        [
                            '1' => 'Active',
                            '0' => 'Deactive',
                        ]
                    ),

                Forms\Components\FileUpload::make('profile_image')
                    ->image()
                    ->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('height')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('initial_weight')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('age')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
