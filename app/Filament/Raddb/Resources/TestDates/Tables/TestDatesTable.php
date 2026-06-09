<?php

namespace App\Filament\Raddb\Resources\TestDates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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
            ])
            ->deferFilters(false)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
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
