<?php

namespace App\Filament\Admin\Resources\Modalities\Schemas;

use App\Models\Modality;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ModalityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('modality'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Modality $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
