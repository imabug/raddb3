<?php

namespace App\Filament\Raddb\Resources\TestDates\Tables;

use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
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
            ])
            ->deferFilters(false)
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
