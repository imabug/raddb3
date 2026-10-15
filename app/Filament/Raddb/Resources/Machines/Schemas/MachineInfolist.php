<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;


use App\Filament\Raddb\Resources\Machines\Schemas\Components\MachineInfoTab;
use App\Filament\Raddb\Resources\Machines\Schemas\Components\MachineOpNotesTab;
use App\Filament\Raddb\Resources\Machines\Schemas\Components\MachineSiteInfoTab;
use App\Filament\Raddb\Resources\Machines\Schemas\Components\MachineSurveysTab;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class MachineInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        MachineSiteInfoTab::make(),
                        MachineInfoTab::make(),
                        MachineOpNotesTab::make(),
                        MachineSurveysTab::make(),
                    ]),
            ]);
    }
}
