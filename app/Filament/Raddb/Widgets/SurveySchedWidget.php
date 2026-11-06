<?php

namespace App\Filament\Raddb\Widgets;

use App\Filament\Raddb\Resources\SurveyScheduleViews\Tables\SurveyScheduleViewsTable;
use App\Models\SurveyScheduleView;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class SurveySchedWidget extends TableWidget
{
    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return SurveyScheduleViewsTable::configure($table)
            ->query(fn(): Builder => SurveyScheduleView::query()->orderBy('prevSurveyDate', 'asc'));
    }
}
