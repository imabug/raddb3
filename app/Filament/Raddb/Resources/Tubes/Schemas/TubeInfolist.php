<?php

namespace App\Filament\Raddb\Resources\Tubes\Schemas;

use App\Models\Tube;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TubeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('machine.id')
                    ->label('Machine'),
                TextEntry::make('housingManuf.id')
                    ->label('Housing manuf')
                    ->placeholder('-'),
                TextEntry::make('housing_model')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('housing_sn')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('insertManuf.id')
                    ->label('Insert manuf')
                    ->placeholder('-'),
                TextEntry::make('insert_model')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('insert_sn')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('manuf_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('install_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('remove_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('lfs')
                    ->numeric(),
                TextEntry::make('mfs')
                    ->numeric(),
                TextEntry::make('sfs')
                    ->numeric(),
                TextEntry::make('tube_status')
                    ->badge(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Tube $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
