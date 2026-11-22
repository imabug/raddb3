<?php

namespace App\Filament\Admin\Resources\Locations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
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
            ->defaultPaginationPageOption(50)
            ->extremePaginationLinks()
            ->striped(true)
            ->lazyLoaded(true)
            ->recordActions([
                ViewAction::make()
                    ->iconButton(),
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
