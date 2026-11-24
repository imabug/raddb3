<?php

namespace App\Filament\Raddb\Resources\TestDates\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;

class AddReportForm
{
    public static function make(): array
    {
        return [
            TextInput::make('surveyId')
                ->label('Survey ID')
                ->integer(true),
            SpatieMediaLibraryFileUpload::make('surveyReport')
                ->disk('SurveyReports'),
        ];
    }
}
