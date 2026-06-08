<?php

namespace App\Filament\Admin\Resources\Modalities\Pages;

use App\Filament\Admin\Resources\Modalities\ModalityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewModality extends ViewRecord
{
    protected static string $resource = ModalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
