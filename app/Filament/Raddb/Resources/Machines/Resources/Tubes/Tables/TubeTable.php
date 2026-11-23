<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Tables;

use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Actions\TubeDeleteAction;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Actions\TubeRestoreAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TubeTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('housingManuf.manufacturer')
                    ->label('Housing Manufacturer'),
                TextColumn::make('housing_model'),
                TextColumn::make('housing_sn')
                    ->label('Housing SN'),
                TextColumn::make('insertManuf.manufacturer')
                    ->label('Insert Manufacturer'),
                TextColumn::make('insert_model')
                    ->label('Insert model'),
                TextColumn::make('insert_sn')
                    ->label('Insert SN'),
                TextColumn::make('manuf_date')
                    ->label('Manufacture date')
                    ->date('Y-m-d'),
                TextColumn::make('install_date')
                    ->label('Install date')
                    ->date('Y-m-d'),
                TextColumn::make('lfs')
                    ->label('Large FS (mm)')
                    ->numeric(),
                TextColumn::make('mfs')
                    ->label('Med FS (mm)')
                    ->numeric(),
                TextColumn::make('sfs')
                    ->label('Small FS (mm)')
                    ->numeric(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->deferFilters(false)
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    TubeDeleteAction::configure(),
                    TubeRestoreAction::configure(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    TubeDeleteAction::configureBulk(),
                    TubeRestoreAction::configureBulk(),
                ]),
            ]);
    }
}
