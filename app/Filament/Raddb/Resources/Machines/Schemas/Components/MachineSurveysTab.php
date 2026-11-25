<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas\Components;

use App\Models\TestDate;
use BackedEnum;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;

class MachineSurveysTab
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function make(): Tab
    {
        return Tab::make('Surveys')
            ->schema([
                RepeatableEntry::make('testDate')
                    ->hiddenLabel()
                    ->table([
                        TableColumn::make('Survey ID'),
                        TableColumn::make('Survey date'),
                        TableColumn::make('Test type'),
                        TableColumn::make('Accession'),
                        TableColumn::make('Notes'),
                    ])
                    ->schema([
                        TextEntry::make('id')
                            ->icon(function ($state): ?BackedEnum {
                                // Display an icon if a survey report is available
                                return TestDate::find($state)
                                    ->hasMedia('survey_reports') ? Heroicon::OutlinedDocumentText : null;
                            })
                            ->iconPosition(IconPosition::After)
                            ->url(function ($state) {
                                // Link to the survey report if available
                                $t = TestDate::find($state);

                                return $t->hasMedia('survey_reports') ? $t->getFirstMediaUrl('survey_reports') : null;
                            }),
                        TextEntry::make('test_date')
                            ->date('Y-m-d'),
                        TextEntry::make('testType.test_type')
                            ->wrap(false),
                        TextEntry::make('accession')
                            ->wrap(false),
                        TextEntry::make('notes')
                            ->wrap(),
                    ]),
            ])
            ->columnSpanFull();
    }
}
