<?php

namespace App\Filament\Raddb\Pages;

use App\Filament\Tables\SurveyStatusTable;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use UnitEnum;

class SurveyStatus extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.raddb.pages.survey-status';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static string|UnitEnum|null $navigationGroup = 'Surveys';

    public static function table(Table $table): Table
    {
        return SurveyStatusTable::configure($table);
    }
}
