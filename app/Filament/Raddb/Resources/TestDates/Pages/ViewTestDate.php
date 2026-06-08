<?php

namespace App\Filament\Raddb\Resources\TestDates\Pages;

use App\Filament\Raddb\Resources\TestDates\TestDateResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTestDate extends ViewRecord
{
    protected static string $resource = TestDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
