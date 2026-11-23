<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Pages;

use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Actions\TubeDeleteAction;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Actions\TubeRestoreAction;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTube extends EditRecord
{
    protected static string $resource = TubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            TubeDeleteAction::configure(),
            TubeRestoreAction::configure(),
        ];
    }
}
