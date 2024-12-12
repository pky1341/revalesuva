<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use App\Mail\UserCredentialsMail;
use Exception;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use TomatoPHP\FilamentApi\Traits\InteractWithAPI;

class CreateUser extends CreateRecord
{
    use InteractWithAPI;
    
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    protected function afterCreate()
    {
        $user = $this->record;
        $password = $this->data['password'];
        try{
            Mail::to($user->email)->send(new UserCredentialsMail($user->email, $password));
            $user->email_verified_at = now();
            $user->save();
        }catch(Exception $e){
            Log::error("Failed to send Email. :{$e->getMessage()}");
        }
    }

    protected function getPassword(): string
    {
        return $this->record->password;
    }
}
