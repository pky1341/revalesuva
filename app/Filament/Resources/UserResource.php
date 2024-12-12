<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(25),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                Hidden::make('password')
                    ->default(fn() => Str::random(8)),
                TextInput::make('user_name')
                    ->disabled(),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->required()
                    ->preload()
                    ->reactive()
                    ->searchable(),
                Select::make('gender')
                    ->options([
                        'male' => 'male',
                        'female' => 'female',
                    ])->required(),
                TextInput::make('contact_number')
                    ->tel(),
                TextInput::make('height')
                    ->numeric(),
                TextInput::make('initial_weight')
                    ->numeric(),
                DatePicker::make('date_of_birth'),
                Select::make('regular_period')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ]),
                DatePicker::make('date_of_last_period'),
                TextInput::make('number_of_cycle_days')
                    ->numeric(),
                TextInput::make('street'),
                TextInput::make('house'),
                TextInput::make('apartment'),
                TextInput::make('zipcode')
                    ->integer(true),
                Select::make('city')
                    ->options([
                        'surat' => 'surat',
                    ]),
                Select::make('personal_status')
                    ->options([
                        'married' => 'married',
                        'unmarried' => 'unmarried',
                    ]),
                TextInput::make('occupation'),
                Select::make('is_active')
                    ->options(
                        [
                            '1' => 'Active',
                            '0' => 'Deactive',
                        ]
                    ),
                FileUpload::make('profile_image')
                    ->image()
                    ->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable()->sortable(),
                TextColumn::make('contact_number')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')->sortable(),
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
