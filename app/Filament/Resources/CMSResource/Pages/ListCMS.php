<?php

namespace App\Filament\Resources\CMSResource\Pages;

use App\Filament\Resources\CMSResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCMS extends ListRecords
{
    protected static string $resource = CMSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
