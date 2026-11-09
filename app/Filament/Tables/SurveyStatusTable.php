<?php

namespace App\Filament\Tables;

use App\Models\Machine;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SurveyStatusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->lazyLoaded()
            ->query(
                fn(): Builder => Machine::query()
                ->active()
                ->without(['manufacturer', 'tube'])
                ->with([
                    // Get the most recent test date through the testDate relationship
                    'testDate' => function ($query) {
                        $query->where('test_type_id', '1')
                            ->orWhere('test_type_id', '2')
                            ->latest('test_date')
                            ->limit(1);
                    },
                ])
                ->noTestEquipment()
                // ->where('modality_id', '<>', '19'), // Exclude test equipment (modality_id 19)
            )
            ->columns([
                Stack::make([
                    TextColumn::make('description')
                        ->searchable()
                        ->url(
                            fn(Model $record): string => route('filament.raddb.resources.machines.view', ['record' => $record->id]),
                        ),
                    TextColumn::make('location.location')
                        ->sortable(),
                    TextColumn::make('modality.modality')
                        ->label('Modality')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('testDate.test_date')
                        ->date('Y-m-d')
                        ->badge()
                        ->color(fn(Model $record): string|array => $record->surveyStatus->getColor())
                        ->tooltip(fn(Model $record): string|array => $record->surveyStatus->getDescription()),
                ]),
            ])
            ->contentGrid([
                'md' => 3,
                'xl' => 4,
                '2xl' => 5,
            ])
            ->filters([
                SelectFilter::make('facility')
                    ->relationship('facility', 'facility'),
                SelectFilter::make('modality')
                    ->relationship('modality', 'modality'),
            ])
            ->deferFilters(false)
            ->groups([
                Group::make('facility.facility')
                    ->collapsible(),
                Group::make('modality.modality')
                    ->collapsible(),
            ])
            ->defaultGroup('facility.facility')
            ->paginated([10, 50, 100, 'all'])
            ->defaultPaginationPageOption(10)
            ->extremePaginationLinks()
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
