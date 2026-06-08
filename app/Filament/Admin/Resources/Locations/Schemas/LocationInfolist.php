<?php

namespace App\Filament\Admin\Resources\Locations\Schemas;

use App\Models\Location;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LocationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('facility.facility')
                    ->label('Facility'),
                TextEntry::make('location'),
            ]);
    }
}
