<?php

namespace App\Filament\Admin\Resources\Manufacturers\Tables;

use App\Filament\Actions\TableDeleteAction;
use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ManufacturersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('manufacturer')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('manufacturer', 'asc')
            ->paginated([10, 50, 'all'])
            ->defaultPaginationPageOption(10)
            ->filters([
                TrashedFilter::make(),
            ])
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
