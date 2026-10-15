<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas\Components;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs\Tab;

class MachineOpNotesTab
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function make(): Tab
    {
        return Tab::make('Operational Notes')
                ->schema([
                    RepeatableEntry::make('op_notes')
                        ->hiddenLabel()
                        ->schema([
                            TextEntry::make('note')
                                ->hiddenLabel(),
                        ])
                        ->grid(2),
                ])
                ->columnSpanFull();
    }
}
