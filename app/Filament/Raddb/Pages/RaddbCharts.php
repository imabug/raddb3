<?php

namespace App\Filament\Raddb\Pages;

use App\Filament\Admin\Widgets\FacilityMachinesCount;
use App\Filament\Admin\Widgets\ModalityMachineCount;
use App\Filament\Admin\Widgets\MonthlySurveyCount;
use App\Filament\Admin\Widgets\SurveyCategoryCount;
use App\Filament\Admin\Widgets\YearlySurveyCount;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Override;

class RaddbCharts extends Page
{
    protected string $view = 'filament.raddb.pages.raddb-charts';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

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
