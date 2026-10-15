<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas\Components;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs\Tab;

class MachineInfoTab
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function make(): Tab
    {
        return Tab::make('Machine information')
                ->inlineLabel()
                ->schema([
                    TextEntry::make('manufacturer.manufacturer')
                        ->label('Manufacturer: ')
                        ->placeholder('-'),
                    TextEntry::make('modality.modality')
                        ->label('Modality: ')
                        ->placeholder('-'),
                    TextEntry::make('model')
                        ->label('Model: ')
                        ->placeholder('-'),
                    TextEntry::make('serial_number')
                        ->label('Serial #: ')
                        ->placeholder('-'),
                    TextEntry::make('software_version')
                        ->label('Software version: ')
                        ->placeholder('-'),
                    TextEntry::make('vend_site_id')
                        ->label('Vendor site ID: ')
                        ->placeholder('-'),
                    TextEntry::make('manuf_date')
                        ->label('Manufacture date: ')
                        ->date('Y-m-d')
                        ->placeholder('-'),
                    TextEntry::make('age')
                        ->label('Age (years): ')
                        ->placeholder('-'),
                ])
                ->columns(2);
    }
}
