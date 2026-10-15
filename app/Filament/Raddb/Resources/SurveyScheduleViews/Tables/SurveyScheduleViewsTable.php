<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Tables;

use App\Models\TestDate;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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
                    ->label('Prev Survey ID')
                    ->icon(function ($state): ?BackedEnum {
                        return TestDate::find($state)->hasMedia('survey_reports') ? Heroicon::DocumentText : null;
                    })
                    ->iconPosition(IconPosition::After)
                    ->url(function ($state) {
                        $t = TestDate::find($state);

                        return $t->hasMedia('survey_reports') ? $t->getFirstMediaUrl('survey_reports') : null;
                    }),
                TextColumn::make('prevSurveyDate')
                    ->label('Prev Survey Date')
                    ->date('Y-m-d')
                    ->sortable(),
                TextColumn::make('currSurveyId')
                    ->label('Current Survey ID')
                    ->icon(function ($state): ?BackedEnum {
                        return TestDate::find($state)->hasMedia('survey_reports') ? Heroicon::DocumentText : null;
                    })
                    ->iconPosition(IconPosition::After)
                    ->url(function ($state) {
                        $t = TestDate::find($state);

                        return $t->hasMedia('survey_reports') ? $t->getFirstMediaUrl('survey_reports') : null;
                    }),
                TextColumn::make('currSurveyDate')
                    ->label('Current Survey Date')
                    ->date('Y-m-d')
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
                                fn (Builder $query, $date): Builder => $query->whereDate('currSurveyDate', '>=', $date),
                            )
                            ->when(
                                $data['surveyEnd'],
                                fn (Builder $query, $date): Builder => $query->whereDate('currSurveyDate', '<=', $date),
                            );
                    }),
            ]);
    }
}
