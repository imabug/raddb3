<?php

namespace App\Filament\Raddb\Resources\Machines\Pages;

use App\Filament\Raddb\Resources\Machines\MachineResource;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMachines extends ListRecords
{
    protected static string $resource = MachineResource::class;

    protected static ?string $relatedResource = TubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
