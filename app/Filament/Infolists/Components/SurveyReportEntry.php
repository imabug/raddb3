<?php

namespace App\Filament\Infolists\Components;

use App\Models\TestDate;
use Filament\Infolists\Components\Entry;

class SurveyReportEntry extends Entry
{
    protected string $view = 'filament.infolists.components.survey-report-entry';

    public function getSurveyLink(?int $surveyID): ?string
    {
        $survey = TestDate::find($surveyID);

        if (!is_null($survey) && $survey->hasMedia('survey_reports')) {
            return $survey->getFirstMediaUrl('surveyReports');
        } else {
            return null;
        }
    }
}
