<?php

namespace App\Filament\Raddb\Widgets;

use App\Models\Machine;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class FacilityMachinesCount extends ChartWidget
{
    protected ?string $heading = 'Facility Machines Count';
    protected ?string $pollingInterval = null;
    protected static ?int $sort = 5;

    public function getDescription(): string|Htmlable|null
    {
        return 'Number of machines at each facility.';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'colors' => [
                    'enabled' => "true",
                    'forceOverride' => "true",
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $machines = Machine::active()
            ->get()
            ->countBy('facility.facility')
            ->sortDesc();

        return [
            'datasets' => [
                [
                    'data' => $machines->flatten(1)->all(),
                ],
            ],
            'labels' => $machines->keys()->all(),

        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
