<?php

namespace App\Filament\Resources\InquiryServiceResource\Pages;

use App\Filament\Resources\InquiryServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInquiryService extends EditRecord
{
    protected static string $resource = InquiryServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
