<?php

namespace App\Filament\Raddb\Resources\TestDates\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TestDateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('machine.description')
                    ->label('Machine'),
                TextEntry::make('testType.test_type')
                    ->label('Test type'),
                TextEntry::make('test_date')
                    ->dateTime(),
                TextEntry::make('accession')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}
