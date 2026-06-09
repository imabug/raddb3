<?php

namespace App\Filament\Admin\Resources\Facilities\Tables;

use App\Filament\Actions\TableDeleteAction;
use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class FacilitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('facility')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('street_address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('state')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('zip_code')
                    ->searchable(),
            ])
            ->defaultSort('facility', 'asc')
            ->groups([
                Group::make('city')
                ->collapsible(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->paginated([10, 50, 'all'])
            ->defaultPaginationPageOption(10)
            ->recordActions([
                TableViewAction::make(),
                TableEditAction::make(),
                TableDeleteAction::make(),
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
