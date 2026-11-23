<?php

namespace App\Filament\Raddb\Resources\Machines\Pages;

use App\Filament\Raddb\Resources\Machines\Actions\MachineDeleteAction;
use App\Filament\Raddb\Resources\Machines\Actions\MachineRestoreAction;
use App\Filament\Raddb\Resources\Machines\MachineResource;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMachine extends EditRecord
{
    protected static string $resource = MachineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            MachineDeleteAction::configure(),
            MachineRestoreAction::configure(),
        ];
    }
}
