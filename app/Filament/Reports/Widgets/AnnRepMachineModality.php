<?php

namespace App\Filament\Reports\Widgets;

use App\Models\Machine;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class AnnRepMachineModality extends TableWidget
{
    use InteractsWithPageFilters;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Machine count by modality')
            ->records(function (): array {
                $machines = Machine::active()->get();
                $totMachines = $machines->count();
                $i = 1;
                foreach ($machines->groupBy('modality.modality') as $mod => $m) {
                    $modCount[$i] = [
                        'modality' => $mod,
                        'count' => $m->count(),
                        'percent' => ($m->count()/$totMachines)*100,
                    ];
                    $i++;
                }
                $modCount[$i] = [
                    'modality' => 'Total',
                    'count' => $totMachines,
                    'percent' => 100,
                ];
                return $modCount;
            })
            ->columns([
                TextColumn::make('modality')
                    ->label('Modality'),
                TextColumn::make('count')
                    ->label('Number'),
                TextColumn::make('percent')
                    ->label('Percent')
                    ->numeric(decimalPlaces: 1),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
