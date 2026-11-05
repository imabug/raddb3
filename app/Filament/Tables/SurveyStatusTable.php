<?php

namespace App\Filament\Tables;

use App\Enums\Status;
use App\Models\Machine;
use DateTimeImmutable;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                        ->searchable(),
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
                            $today = new DateTimeImmutable("now");
                            $test_date = new DateTimeImmutable($state);
                            $days = $test_date->diff($today)->format('%a');
                            if ($days < 335) {
                                if ($test_date > $today) {
                                    $status = Status::Scheduled;
                                } else {
                                   $status = Status::Current;
                                }
                            } else if (($days >= 335) && ($days < 365)) {
                                $status = Status::Due30d;
                            } else if (($days >= 365) && ($days < 395)) {
                                $status = Status::Overdue13m;
                            } else if ($days > 395) {
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
                //
            ])
            ->groups([
                Group::make('facility.facility')
                    ->collapsible(),
            ])
            ->defaultGroup('facility.facility')
            ->paginated([10, 50, 100, 'all'])
            ->defaultPaginationPageOption(10)
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
