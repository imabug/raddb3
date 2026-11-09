<?php

namespace App\Filament\Reports\Pages;

use App\Models\TestDate;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AnnRepDashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected int|string|array $columnSpan = 'full';

    public function getColumns(): int|array
    {
         return 2;
    }

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('reportYear')
                            ->options(function (): array {
                                // Get a collection of all the survey years in the database
                                $years = TestDate::without('machine', 'testType')
                                    ->selectRaw('year(test_date) as years')
                                    ->distinct()
                                    ->orderBy('years', 'desc')
                                    ->get();
                        
                                if (count($years) > 0) {
                                    foreach ($years as $y) {
                                        $yearFilter[$y['years']] = $y['years'];
                                    }
                                } else {
                                    $yearFilter = ['' => ''];
                                }
                        
                                return $yearFilter;
                            })
                            ->selectablePlaceholder(false),
                    ])
                    ->columns(1),
            ]);
    }
}
