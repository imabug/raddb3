<?php

namespace App\Filament\Raddb\Pages;

use App\Filament\Widgets\FacilityMachinesCount;
use App\Filament\Widgets\ModalityMachineCount;
use App\Filament\Widgets\MonthlySurveyCount;
use App\Filament\Widgets\SurveyCategoryCount;
use App\Filament\Widgets\YearlySurveyCount;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class RaddbCharts extends Page
{
    protected string $view = 'filament.raddb.pages.raddb-charts';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?string $title = "RadDB Charts";

    protected function getHeaderWidgets(): array
    {
        return [
            FacilityMachinesCount::class,
            ModalityMachineCount::class,
            MonthlySurveyCount::class,
            SurveyCategoryCount::class,
            YearlySurveyCount::class,
        ];
    }
}
