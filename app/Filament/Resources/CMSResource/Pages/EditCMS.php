<?php

namespace App\Filament\Resources\CMSResource\Pages;

use App\Filament\Resources\CMSResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCMS extends EditRecord
{
    protected static string $resource = CMSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
