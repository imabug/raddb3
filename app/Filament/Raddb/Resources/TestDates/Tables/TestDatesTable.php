<?php

namespace App\Filament\Raddb\Resources\TestDates\Tables;

use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestDatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('machine.description')
                    ->searchable(),
                TextColumn::make('testType.test_type')
                    ->searchable(),
                TextColumn::make('test_date')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),
                TextColumn::make('accession')
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('pending')
                    ->label('Pending')
                    ->query(fn(Builder $query): Builder => $query->activeMachines()->pending())
                    ->toggle()
                    ->default(),
                Filter::make('activeMachines')
                    ->label('Active machines')
                    ->query(fn(Builder $query): Builder => $query->activeMachines())
                    ->toggle(),
                // TODO: Toggle prevYear/currYear filters depending on the state of the other filter
                // i.e. if prevYear is toggled on, toggling currYear on should toggle prevYear off but
                // leave prevYear if it's already off.
                Filter::make('prevYear')
                    ->label('Previous year')
                    ->query(fn(Builder $query): Builder => $query->year(date('Y') - 1))
                    ->toggle(),
                Filter::make('currYear')
                    ->label('Current year')
                    ->query(fn(Builder $query): Builder => $query->year(date('Y')))
                    ->toggle(),
                SelectFilter::make('testType')
                    ->relationship('testType', 'test_type'),
                Filter::make('surveyDateRange')
                    ->label('Survey date range')
                    ->schema([
                        DatePicker::make('surveyStart')
                            ->label('Survey start date'),
                        DatePicker::make('surveyEnd')
                            ->label('Survey end date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['surveyStart'],
                                fn(Builder $query, $date): Builder => $query->whereDate('test_date', '>=', $date),
                            )
                            ->when(
                                $data['surveyEnd'],
                                fn(Builder $query, $date): Builder => $query->whereDate('test_date', '<=', $date),
                            );
                    }),
            ])
            ->deferFilters(false)
            ->paginated([10, 50, 'all'])
            ->recordActions([
                TableViewAction::make(),
                TableEditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
