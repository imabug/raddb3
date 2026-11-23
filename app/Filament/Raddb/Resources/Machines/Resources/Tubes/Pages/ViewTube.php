<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Pages;

use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTube extends ViewRecord
{
    protected static string $resource = TubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            EditAction::make(),
        ];
    }
}
