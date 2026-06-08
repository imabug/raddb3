<?php

namespace App\Filament\Admin\Resources\Manufacturers\Pages;

use App\Filament\Admin\Resources\Manufacturers\ManufacturerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewManufacturer extends ViewRecord
{
    protected static string $resource = ManufacturerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
