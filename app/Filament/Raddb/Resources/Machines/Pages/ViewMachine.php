<?php

namespace App\Filament\Raddb\Resources\Machines\Pages;

use App\Filament\Raddb\Resources\Machines\Actions\MachineDeleteAction;
use App\Filament\Raddb\Resources\Machines\Actions\MachineRestoreAction;
use App\Filament\Raddb\Resources\Machines\MachineResource;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMachine extends ViewRecord
{
    protected static string $resource = MachineResource::class;

    protected static ?string $relatedResource = TubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            MachineDeleteAction::configure(),
            MachineRestoreAction::configure(),
        ];
    }
}
