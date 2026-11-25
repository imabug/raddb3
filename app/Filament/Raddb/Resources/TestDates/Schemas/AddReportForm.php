<?php

namespace App\Filament\Raddb\Resources\TestDates\Schemas;

use App\Models\TestDate;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AddReportForm
{
    public static function make(): array
    {
        return [
            TextInput::make('surveyId')
                ->label('Survey ID')
                ->integer(true)
                ->default(function ($record) {
                    return $record->id;
                })
                ->exists(TestDate::class, 'id'),
            SpatieMediaLibraryFileUpload::make('surveyReport')
                ->disk('SurveyReports')
                ->collection('survey_reports')
                ->multiple(false)
                ->acceptedFileTypes(['application/pdf'])
                ->preserveFilenames()
                ->moveFiles()
                ->customProperties([
                    'hash' => function (TemporaryUploadedFile $file): string {
                        return hash_file('sha512', $file->getRealPath(), false);
                    },
                ]),
        ];
    }
}
