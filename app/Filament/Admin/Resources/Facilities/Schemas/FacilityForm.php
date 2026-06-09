<?php

namespace App\Filament\Admin\Resources\Facilities\Schemas;

use App\Enums\USState;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('facility')
                    ->required()
                    ->string()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('street_address')
                    ->string()
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('city')
                    ->string()
                    ->maxLength(255)
                    ->default(null),
                Select::make('state')
                    ->options(USState::class)
                    ->required(),
                TextInput::make('zip_code')
                    ->string()
                    ->maxLength(10)
                    ->default(null),
            ]);
    }
}
