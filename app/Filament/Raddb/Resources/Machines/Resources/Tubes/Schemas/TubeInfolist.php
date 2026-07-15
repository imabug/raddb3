<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Schemas;

use App\Models\Tube;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TubeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('machine.description')
                    ->label('Machine'),
                TextEntry::make('housingManuf.manufacturer')
                    ->label('Housing Manufacturer')
                    ->placeholder('-'),
                TextEntry::make('housing_model')
                    ->label('Housing Model')
                    ->placeholder('-'),
                TextEntry::make('housing_sn')
                    ->label('Housing SN')
                    ->placeholder('-'),
                TextEntry::make('insertManuf.manufacturer')
                    ->label('Insert Manufacturer')
                    ->placeholder('-'),
                TextEntry::make('insert_model')
                    ->label('Insert Model')
                    ->placeholder('-'),
                TextEntry::make('insert_sn')
                    ->label('Insert SN')
                    ->placeholder('-'),
                TextEntry::make('manuf_date')
                    ->label('Manufacture date')
                    ->date('Y-m-d')
                    ->placeholder('-'),
                TextEntry::make('install_date')
                    ->label('Install date')
                    ->date('Y-m-d')
                    ->placeholder('-'),
                TextEntry::make('remove_date')
                    ->label('Removal date')
                    ->date('Y-m-d')
                    ->placeholder('-'),
                TextEntry::make('lfs')
                    ->label('Large FS (mm)')
                    ->numeric(),
                TextEntry::make('mfs')
                    ->label('Medium FS (mm)')
                    ->numeric(),
                TextEntry::make('sfs')
                    ->label('Small FS (mm)')
                    ->numeric(),
                TextEntry::make('tube_status')
                    ->badge(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn(Tube $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
