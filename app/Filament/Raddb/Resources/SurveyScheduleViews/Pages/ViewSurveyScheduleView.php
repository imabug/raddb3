<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Pages;

use App\Filament\Raddb\Resources\SurveyScheduleViews\SurveyScheduleViewResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSurveyScheduleView extends ViewRecord
{
    protected static string $resource = SurveyScheduleViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
