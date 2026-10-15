<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas\Components;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;

class MachineSiteInfoTab
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
        return Tab::make('Site information')
                ->inlineLabel()
                ->schema([
                    TextEntry::make('id')
                        ->label('Machine ID: '),
                    TextEntry::make('facility.facility')
                        ->label('Facility: ')
                        ->placeholder('-'),
                    TextEntry::make('location.location')
                        ->label('Location: ')
                        ->placeholder('-'),
                    TextEntry::make('room')
                        ->label('Room: ')
                        ->placeholder('-'),
                    TextEntry::make('install_date')
                        ->label('Install date: ')
                        ->date('Y-m-d')
                        ->placeholder('-'),
                    TextEntry::make('remove_date')
                        ->label('Removal date: ')
                        ->date('Y-m-d')
                        ->placeholder('-')
                        ->visible(fn(Get $get): bool => ($get('machine_status') == 'Active') ? true : false),
                    TextEntry::make('machine_status')
                        ->label('Status: ')
                        ->badge()
                        ->placeholder('-'),
                    TextEntry::make('pacs_station')
                        ->label('PACS station: ')
                        ->placeholder('-'),
                    TextEntry::make('notes')
                        ->label('Notes: ')
                        ->placeholder('-')
                        ->columnSpanFull(),
                ])
                ->columns(2);
    }
}
