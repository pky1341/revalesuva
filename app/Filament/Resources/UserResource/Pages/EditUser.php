<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentApi\Traits\InteractWithAPI;

class EditUser extends EditRecord
{
    use InteractWithAPI;
    
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = $this->record;
        $data['password'] =$user->password;
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
