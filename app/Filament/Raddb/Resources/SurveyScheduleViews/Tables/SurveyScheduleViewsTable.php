<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Tables;

use App\Filament\Tables\Columns\SurveySchedReportLink;
use App\Models\SurveyScheduleView;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SurveyScheduleViewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Machine ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Machine')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('prevSurveyId')
                    ->label('Prev Survey ID'),
                SurveySchedReportLink::make('prevSurvLink')
                    ->surveyLink(fn (SurveyScheduleView $record): int => $record->prevSurveyId),
                TextColumn::make('prevSurveyDate')
                    ->label('Prev Survey Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('currSurveyId')
                    ->label('Current Survey ID'),
                TextColumn::make('currSurveyDate')
                    ->label('Current Survey Date')
                    ->date()
                    ->sortable(),
            ])
            ->paginated(false)
            ->striped()
            ->filters([
                // SelectFilter::make('machine.facility.facility')
                //     ->label('Facility')
                //     ->multiple()
                //     ->options(fn(): array => Facility::query()
                //         ->pluck('facility', 'id')
                //         ->all()),
                Filter::make('surveyDateRange')
                    ->label('Survey date range')
                    ->schema([
                        DatePicker::make('surveyStart')
                            ->label('Survey start date'),
                        DatePicker::make('surveyEnd')
                            ->label('Survey end date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['surveyStart'],
                                fn(Builder $query, $date): Builder => $query->whereDate('currSurveyDate', '>=', $date),
                            )
                            ->when(
                                $data['surveyEnd'],
                                fn(Builder $query, $date): Builder => $query->whereDate('currSurveyDate', '<=', $date),
                            );
                    }),
            ])
            ->groups([
                Group::make('machine.facility.facility')
                    ->label('Facility')
                    ->collapsible(),
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }
}
