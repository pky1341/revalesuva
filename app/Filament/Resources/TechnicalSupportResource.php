<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicalSupportResource\Pages;
use App\Filament\Resources\TechnicalSupportResource\RelationManagers;
use App\Models\TechnicalSupport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TechnicalSupportResource extends Resource
{
    protected static ?string $model = TechnicalSupport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('help_question')
                    ->searchable(),
                TextColumn::make('help_details'),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTechnicalSupports::route('/'),
            'create' => Pages\CreateTechnicalSupport::route('/create'),
            'edit' => Pages\EditTechnicalSupport::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
