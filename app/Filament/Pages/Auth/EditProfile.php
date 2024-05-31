<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile

{
    protected static string $layout = 'filament-panels::components.layout.index';

    protected static string $view = 'filament-panels::pages.auth.edit-profile'; 


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('username')
                //     ->required()
                //     ->maxLength(255),
                // $this->getNameFormComponent(),
                // $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
