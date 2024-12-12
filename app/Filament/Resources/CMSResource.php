<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CMSResource\Pages;
use App\Filament\Resources\CMSResource\RelationManagers;
use App\Models\CMS;
use App\Models\ContentManagementSystem;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CMSResource extends Resource
{
    protected static ?string $model = ContentManagementSystem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'content-management-system';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title'),
                TextInput::make('slug'),
                RichEditor::make('description'),
                Select::make('is_active')
                    ->options([
                        '0' => 'Inactive',
                        '1' => 'Active',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                IconColumn::make('is_active')->boolean(),
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
            'index' => Pages\ListCMS::route('/'),
            'create' => Pages\CreateCMS::route('/create'),
            'edit' => Pages\EditCMS::route('/{record}/edit'),
        ];
    }
}
