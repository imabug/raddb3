<?php

namespace App\Filament\Admin\Resources\Manufacturers\Schemas;

use App\Models\Manufacturer;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ManufacturerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('manufacturer'),
            ]);
    }
}
