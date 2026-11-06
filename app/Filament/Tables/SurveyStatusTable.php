<?php

namespace App\Filament\Tables;

use App\Enums\Status;
use App\Models\Machine;
use DateTimeImmutable;
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
            ->query(fn (): Builder => Machine::query()
                ->active()
                ->without(['manufacturer','tube'])
                ->with([
                    // Get the most recent test date through the testDate relationship
                    'testDate' => function ($query) {
                       $query->where('test_type_id', '1')
                        ->orWhere('test_type_id', '2')
                        ->latest('test_date')
                        ->limit(1);
                    },
                ])
                ->where('modality_id', '<>', '19') // Exclude test equipment (modality_id 19)
            )
            ->columns([
                Stack::make([
                    TextColumn::make('description')
                        ->searchable()
                        ->url(
                            fn(Model $record): string => route('filament.raddb.resources.machines.view', ['record' => $record->id])
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
                        ->color(function (string $state) {
                            // Determine badge colour based on survey date and current date
                            $today = new DateTimeImmutable("now");
                            $test_date = new DateTimeImmutable($state);
                            $days = $test_date->diff($today)->format('%a');
                            if ($days < 335) {
                                $status = ($test_date > $today) ? Status::Scheduled : Status::Current;
                            } elseif (($days >= 335) && ($days < 365)) {
                                $status = Status::Due30d;
                            } elseif (($days >= 365) && ($days < 395)) {
                                $status = Status::Overdue13m;
                            } elseif ($days > 395) {
                                $status = Status::Overdue;
                            } else {
                                $status = Status::NeedInfo;
                            }
                            return $status->getColor();
                        }),
                ])
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
                    ->collapsible()
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
