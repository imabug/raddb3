<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

// use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class MachineOpNotesSchema
{
    public static function make(): array
    {
        return [
            // Select::make('machine_id')
            //     ->relationship('machine', 'id')
            //     ->required(),
            Textarea::make('note')
                ->default(null)
                ->columnSpanFull(),
        ];
    }
}
