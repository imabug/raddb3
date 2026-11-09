<?php

namespace App\Filament\Raddb\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class RaddbCharts extends Page
{
    protected string $view = 'filament.raddb.pages.raddb-charts';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?string $title = "RadDB Charts";
    protected int|string|array $columnSpan = 1;
    protected int|string|array $columnStart = 1;

    public function getColumns(): int|array
    {
        return 2;
    }

    public function getColumnSpan(): int
    {
        return $this->columnSpan;
    }

    public function getColumnStart(): int
    {
        return $this->columnStart;
    }
}
