<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use App\Models\Machine;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MachineInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('facility.facility')
                    ->label('Facility')
                    ->placeholder('-'),
                TextEntry::make('location.location')
                    ->label('Location')
                    ->placeholder('-'),
                TextEntry::make('manufacturer.manufacturer')
                    ->label('Manufacturer')
                    ->placeholder('-'),
                TextEntry::make('modality.modality')
                    ->label('Modality')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('model')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('serial_number')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('vend_site_id')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('room')
                    ->placeholder('-'),
                TextEntry::make('install_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('manuf_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('remove_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('machine_status')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('software_version')
                    ->placeholder('-'),
                TextEntry::make('pacs_station')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Machine $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
