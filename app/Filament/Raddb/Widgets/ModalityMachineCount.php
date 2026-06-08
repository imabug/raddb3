<?php

namespace App\Filament\Raddb\Widgets;

use App\Models\Machine;
use Filament\Widgets\ChartWidget;

class ModalityMachineCount extends ChartWidget
{
    protected ?string $heading = 'Machine count by modality';
    protected ?string $pollingInterval = null;
    protected static ?int $sort = 4;

    public function getDescription(): ?string
    {
        return 'Count of active machines by modality.';
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
        $machines = Machine::get()
                    ->countBy('modality.modality')
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
