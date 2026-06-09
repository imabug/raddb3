<?php

namespace App\Filament\Raddb\Resources\TestDates\Schemas;

use App\Models\TestDate;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TestDateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('machine.id')
                    ->label('Machine'),
                TextEntry::make('testType.id')
                    ->label('Test type'),
                TextEntry::make('test_date')
                    ->dateTime(),
                TextEntry::make('accession')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn(TestDate $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
