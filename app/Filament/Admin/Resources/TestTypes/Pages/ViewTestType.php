<?php

namespace App\Filament\Admin\Resources\TestTypes\Pages;

use App\Filament\Admin\Resources\TestTypes\TestTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTestType extends ViewRecord
{
    protected static string $resource = TestTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
