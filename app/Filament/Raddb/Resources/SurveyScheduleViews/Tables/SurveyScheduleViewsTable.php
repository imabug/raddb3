<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Tables;

use App\Filament\Actions\TableEditAction;
use App\Filament\Actions\TableViewAction;
use App\Models\Facility;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
