<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas\Components;

use App\Filament\Infolists\Components\SurveyReportEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Schemas\Components\Tabs\Tab;

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
                            TextEntry::make('id'),
                            TextEntry::make('test_date')
                                ->date('Y-m-d'),
                            TextEntry::make('testType.test_type')
                                ->wrap(false),
                            TextEntry::make('accession')
                                ->beforeContent(SurveyReportEntry::make('surveyReport'))
                                ->wrap(false),
                            TextEntry::make('notes')
                                ->wrap(),
                        ]),
                ])
                ->columnSpanFull();
    }
}