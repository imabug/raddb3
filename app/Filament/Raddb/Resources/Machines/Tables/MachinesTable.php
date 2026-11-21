<?php

namespace App\Filament\Raddb\Resources\Machines\Tables;

use App\Enums\Status;
use App\Filament\Raddb\Resources\Machines\Actions\MachineDeleteAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
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
                TextColumn::make('id')
                    ->label('ID'),
                IconColumn::make('machine_status')
                    ->label('Status'),
                TextColumn::make('description')
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('location.location')
                    ->wrap(),
                TextColumn::make('modality.modality')
                    ->visible(function ($livewire) {
                        // Don't show the modality column if the modality filter is set
                        $filterState = $livewire->getTableFilterState('modality');
                        if (
                            $filterState == null
                            || (is_array($filterState) && $filterState['value'] == '')
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                    ->sortable(),
                TextColumn::make('manufacturer.manufacturer')
                    ->visible(function ($livewire) {
                        // Don't show the manufacturer column if the manufacturer filter is set
                        $filterState = $livewire->getTableFilterState('manufacturer');
                        if ($filterState == null
                             || (is_array($filterState) && $filterState['value'] == '')) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                    ->wrap()
                    ->sortable(),
                TextColumn::make('model')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('serial_number'),
                TextColumn::make('room'),
                TextColumn::make('age')
                    ->sortable(),
            ])
            ->groups([
                Group::make('facility.facility')
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
                    ->query(fn (Builder $query): Builder => $query->where('machine_status', Status::Active))
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
            ->paginated([10, 50, 100])
            ->defaultPaginationPageOption(50)
            ->extremePaginationLinks()
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    MachineDeleteAction::configure(),
                ]),
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
