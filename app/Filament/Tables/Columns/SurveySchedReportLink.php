<?php

namespace App\Filament\Tables\Columns;

use Closure;
use App\Models\TestDate;
use Filament\Tables\Columns\Column;

class SurveySchedReportLink extends Column
{
    protected string $view = 'filament.tables.columns.survey-sched-report-link';

    protected string|Closure|null $surveyLink = null;

    public function surveyLink(int|Closure|null $surveyId): static
    {
        $survey = $surveyId ? TestDate::find($surveyId) : null;

        if (!is_null($survey) && $survey->hasMedia('survey_reports')) {
            $this->surveyLink = $survey->getFirstMediaUrl('survey_reports');
        }

        return $this;
    }

    public function getSurveyLink(): ?string
    {
        return $this->evaluate($this->surveyLink);
    }
}
