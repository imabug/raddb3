<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SurveyScheduleViewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('prevSurveyId')
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('prevSurveyDate'),
                TextInput::make('currSurveyId')
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('currSurveyDate'),
            ]);
    }
}
