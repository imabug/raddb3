<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Tables;

use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TubesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('housingManuf.manufacturer')
                    ->label('Housing Manufacturer')
                    ->searchable(),
                TextColumn::make('housing_model')
                    ->searchable(),
                TextColumn::make('housing_sn')
                    ->label('Housing SN')
                    ->searchable(),
                TextColumn::make('insertManuf.manufacturer')
                    ->label('Insert Manufacturer')
                    ->searchable(),
                TextColumn::make('insert_model')
                    ->searchable(),
                TextColumn::make('insert_sn')
                    ->label('Insert SN')
                    ->searchable(),
                TextColumn::make('manuf_date')
                    ->label('Manufacture date')
                    ->date('Y-m-d')
                    ->sortable(),
                TextColumn::make('install_date')
                    ->label('Install date')
                    ->date('Y-m-d')
                    ->sortable(),
                TextColumn::make('lfs')
                    ->label('Large FS (mm)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('mfs')
                    ->label('Med FS (mm)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sfs')
                    ->label('Small FS (mm)')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
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
