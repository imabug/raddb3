<?php

namespace App\Filament\Raddb\Widgets;

use BackedEnum;
use App\Models\SurveyScheduleView;
use App\Models\TestDate;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class SurveySchedWidget extends TableWidget
{
    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->lazyLoaded(true)
            ->query(fn(): Builder => SurveyScheduleView::query()->orderBy('prevSurveyDate', 'asc'))
            ->heading('Survey schedule')
            ->columns([
                TextColumn::make('id')
                    ->label('Machine ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Machine')
                    ->searchable(),
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
                    ->dateTime('Y-m-d')
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
                    ->label('Curr Survey Date')
                    ->dateTime('Y-m-d')
                    ->sortable(),
            ])
            ->paginated([50, 100, 'all'])
            ->defaultPaginationPageOption(50)
            ->extremePaginationLinks()
            ->striped(true)
            ->filters([
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
