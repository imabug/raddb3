<?php

namespace App\Filament\Raddb\Resources\Machines\Tables;

use App\Enums\Status;
use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\PaginationMode;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MachinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('machine_status'),
                TextColumn::make('location.location')
                    ->searchable(),
                TextColumn::make('modality.modality')
                    ->visible(function ($livewire) {
                        $filterState = $livewire->getTableFilterState('modality');
                        if (
                            $filterState == null
                            || (is_array($filterState) && $filterState['value'] == "")
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                    ->searchable(),
                TextColumn::make('manufacturer.manufacturer')
                    ->visible(function ($livewire) {
                        $filterState = $livewire->getTableFilterState('manufacturer');
                        if ($filterState == null
                            || (is_array($filterState) && $filterState['value'] == "")) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                    ->searchable(),
                TextColumn::make('model')
                    ->searchable(),
                TextColumn::make('serial_number')
                    ->searchable(),
                TextColumn::make('vend_site_id')
                    ->searchable(),
                TextColumn::make('room')
                    ->searchable(),
                TextColumn::make('install_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('manuf_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('remove_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('software_version')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pacs_station')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Group::make('facility.facility')
                    ->collapsible(),
                Group::make('location.location')
                    ->collapsible(),
                Group::make('modality.modality')
                    ->collapsible(),
                Group::make('manufacturer.manufacturer')
                    ->collapsible(),
            ])
            ->defaultGroup('facility.facility')
            ->filters([
                TrashedFilter::make(),
                Filter::make('active')
                    ->query(fn(Builder $query): Builder => $query->where('machine_status', Status::Active))
                    ->toggle()
                    ->default(),
                SelectFilter::make('facility')
                    ->relationship('facility', 'facility'),
                SelectFilter::make('modality')
                    ->relationship('modality', 'modality'),
                SelectFilter::make('manufacturer')
                    ->relationship('manufacturer', 'manufacturer'),
            ])
            ->deferFilters(false)
            ->paginated([10, 50, 'all'])
            ->defaultPaginationPageOption(10)
            ->extremePaginationLinks()
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
