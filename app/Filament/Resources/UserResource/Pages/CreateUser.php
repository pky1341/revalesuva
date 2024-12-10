<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use App\Mail\UserCredentialsMail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;
use TomatoPHP\FilamentApi\Traits\InteractWithAPI;

class CreateUser extends CreateRecord
{
    use InteractWithAPI;
    
    protected static string $resource = UserResource::class;

    protected function afterCreate()
    {
        $user = $this->record;

        Mail::to($user->email)->send(new UserCredentialsMail($user->email, $this->getPassword()));

        parent::afterCreate();
    }

    protected function getPassword(): string
    {
        return $this->record->password;
    }
}
