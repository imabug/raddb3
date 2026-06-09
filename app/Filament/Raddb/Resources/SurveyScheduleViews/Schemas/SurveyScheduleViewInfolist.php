<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SurveyScheduleViewInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID')
                    ->numeric(),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('prevSurveyId')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('prevSurveyDate')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('currSurveyId')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('currSurveyDate')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
