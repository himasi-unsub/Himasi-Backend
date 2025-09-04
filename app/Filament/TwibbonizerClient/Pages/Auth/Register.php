<?php

namespace App\Filament\TwibbonizerClient\Pages\Auth;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;

class Register extends BaseRegister
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.twibbonizer-client.pages.auth.register';

    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create($data);
        // Assign role to user
        $user->assignRole('twibbonizer');
        return $user;
    }
}
