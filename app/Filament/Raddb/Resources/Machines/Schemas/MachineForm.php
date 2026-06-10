<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class MachineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Machine info')
                    ->tabs([
                        Tab::make('Machine info')
                            ->schema(MachineInfoSchema::make()),
                        Tab::make('Operational notes')
                            ->schema(MachineOpNotesSchema::make())
                            ->icon(Heroicon::OutlinedClipboardDocumentList),
                    ])
                    ->contained(false),
            ]);
    }
}
