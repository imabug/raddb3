<?php

namespace App\Filament\Admin\Resources\Locations\Tables;

use App\Filament\Actions\TableDeleteAction;
use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class LocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('location')
                    ->searchable(),
            ])
            ->groups([
                Group::make('facility.facility')
                    ->collapsible(),
            ])
            ->defaultGroup('facility.facility')
            ->filters([
                SelectFilter::make('facility')
                    ->relationship('facility', titleAttribute: 'facility'),
                TrashedFilter::make(),
            ])
            ->deferFilters(false)
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
