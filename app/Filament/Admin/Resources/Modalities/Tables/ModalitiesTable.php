<?php

namespace App\Filament\Admin\Resources\Modalities\Tables;

use App\Filament\Actions\TableDeleteAction;
use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ModalitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('modality')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('modality', 'asc')
            ->paginated([10, 50, 'all'])
            ->defaultPaginationPageOption('all')
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
