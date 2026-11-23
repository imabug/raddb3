<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Pages;

use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTube extends ListRecords
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    protected static string $resource = TubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
