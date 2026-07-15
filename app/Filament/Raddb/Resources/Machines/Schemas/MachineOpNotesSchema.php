<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class MachineOpNotesSchema
{
    public static function make(): array
    {
        return [
            Repeater::make('op_notes')
                ->schema([
                    TextInput::make('note'),
                ]),
        ];
    }
}
