<?php

namespace App\Filament\Reports\Widgets;

use App\Models\Machine;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget;

class AnnRepMachineFacilities extends TableWidget
{
    use InteractsWithPageFilters;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Machine count by facility')
            ->records(function (): array {
                $machines = Machine::active()->get();
                $totMachines = $machines->count();
                $i = 1;
                foreach ($machines->groupBy('facility.facility') as $fac => $m) {
                    $facCount[$i] = [
                        'facility' => $fac,
                        'count' => $m->count(),
                        'percent' => ($m->count()/$totMachines)*100,
                    ];
                    $i++;
                }
                $facCount[$i] = [
                    'facility' => 'Total',
                    'count' => $totMachines,
                    'percent' => 100,
                ];
                return $facCount;
            })
            ->columns([
                TextColumn::make('facility')
                    ->label('Facility'),
                TextColumn::make('count')
                    ->label('Number'),
                TextColumn::make('percent')
                    ->label('Percent')
                    ->numeric(decimalPlaces: 1),
            ]);
    }
}
