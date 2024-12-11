<?php

namespace App\Filament\Resources\InquiryServiceResource\Pages;

use App\Filament\Resources\InquiryServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInquiryServices extends ListRecords
{
    protected static string $resource = InquiryServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
