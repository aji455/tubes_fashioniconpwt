<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class UserForm
{
     public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('phone')
                ->label('Nomor Telepon')
                ->maxLength(20),

            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->minLength(6)
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->required(fn ($context) => $context === 'create')
                ->dehydrated(fn ($state) => filled($state))
                ->confirmed(),

            Forms\Components\TextInput::make('password_confirmation')
                ->label('Konfirmasi Password')
                ->password()
                ->required(fn ($context) => $context === 'create'),
        ]);
    }
}
