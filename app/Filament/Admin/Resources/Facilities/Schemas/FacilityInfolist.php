<?php

namespace App\Filament\Admin\Resources\Facilities\Schemas;

use App\Models\Facility;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FacilityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('facility')
                    ->columnSpanFull(),
                TextEntry::make('street_address')
                    ->placeholder('-'),
                TextEntry::make('city')
                    ->placeholder('-'),
                TextEntry::make('state')
                    ->placeholder('-'),
                TextEntry::make('zip_code')
                    ->placeholder('-'),
            ]);
    }
}
