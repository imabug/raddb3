<?php

namespace App\Filament\Admin\Resources\TestTypes\Schemas;

use App\Models\TestType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TestTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('test_type'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (TestType $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
