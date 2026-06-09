<?php

namespace App\Filament\Raddb\Widgets;

use App\Models\TestDate;
use Filament\Widgets\ChartWidget;

class YearlySurveyCount extends ChartWidget
{
    protected ?string $heading = 'Yearly Survey Count';
    protected ?string $pollingInterval = null;
    protected static ?int $sort = 1;

    public function getDescription(): ?string
    {
        return 'The number of surveys performed each year.  Includes annual and acceptance tests, major service checks, shielding plans and surveys, accreditation surveys.';
    }

    protected function getData(): array
    {
        $yearCounts = TestDate::without('machine','testType')
            ->whereNotIn('test_type_id', [8, 10])
            ->get()
            ->countBy(
                function ($item, $key) {
                    return substr($item['test_date'], 0, 4);
                },
            )
            ->sortKeys();

        if (count($yearCounts) == 0) {
            $yearCounts[] = 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Yearly survey counts',
                    'data' => $yearCounts->flatten()->all(),
                ],
            ],
            'labels' => $yearCounts->keys()->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
