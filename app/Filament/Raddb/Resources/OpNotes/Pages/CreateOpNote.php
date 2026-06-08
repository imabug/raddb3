<?php

namespace App\Filament\Raddb\Resources\OpNotes\Pages;

use App\Filament\Raddb\Resources\OpNotes\OpNoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOpNote extends CreateRecord
{
    protected static string $resource = OpNoteResource::class;
}
