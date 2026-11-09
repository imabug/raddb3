<?php

namespace App\Filament\Reports\Widgets;

use App\Models\TestDate;
use Carbon\CarbonImmutable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget;

class AnnRepSurveyType extends TableWidget
{
    use InteractsWithPageFilters;

    public function table(Table $table): Table
    {
        $reportYear = $this->pageFilters['reportYear'] ?? CarbonImmutable::now()->year;

        return $table
            ->heading('Survey count by test type')
            ->records(
                function () use ($reportYear): array {
                    // Get the list of surveys for the selected year
                    $surveys = TestDate::without('machine')->with('testType')
                        ->year($reportYear)
                        ->get();
                    $i = 1;
                    $tot = $surveys->count();
                    foreach ($surveys->groupBy('testType.test_type') as $type => $s) {
                        $sCount[$i] = [
                            'type' => $type,
                            'count' => $s->count(),
                            'percent' => ($s->count()/$tot)*100,
                        ];
                        $i++;
                        $tot += $s->count();
                    }
                    $sCount[] = [
                        'type' => 'Total',
                        'count' => $tot,
                        'percent' => 100,
                    ];
                    return $sCount;
                }
            )
            ->columns([
                TextColumn::make('type')
                    ->label('Test Type'),
                TextColumn::make('count')
                    ->label('Number'),
                TextColumn::make('percent')
                    ->label('Percent')
                    ->numeric(decimalPlaces: 1)
            ]);
    }
}
