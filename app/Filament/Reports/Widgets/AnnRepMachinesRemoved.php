<?php

namespace App\Filament\Reports\Widgets;

use App\Models\Machine;
use Carbon\CarbonImmutable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class AnnRepMachinesRemoved extends TableWidget
{
    use InteractsWithPageFilters;

    public function table(Table $table): Table
    {
        $reportYear = $this->pageFilters['reportYear'] ?? CarbonImmutable::now()->year;

        return $table
            ->heading('Removed machines')
            ->query(function (Builder $query) use($reportYear): Builder {
                return Machine::query()
                    ->onlyTrashed()
                    ->whereBetween('deleted_at', [$reportYear . '-01-01', $reportYear . '-12-31'])
                    ->orderBy('deleted_at', 'asc');
            })
            ->columns([
                TextColumn::make('description')
                    ->label('Description'),
                TextColumn::make('deleted_at')
                    ->label('Removal date')
                    ->date('Y-m-d'),
            ])
            ->paginated([10, 20, 'all'])
            ->defaultPaginationPageOption(10)
            ->extremePaginationLinks()
            ->striped();
    }
}
