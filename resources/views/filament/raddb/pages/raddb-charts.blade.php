<x-filament-panels::page>
    {{-- Page content --}}
    <x-filament-widgets::widget>
        @livewire(\App\Filament\Widgets\MonthlySurveyCount::class)
    </x-filament-widgets::widget>   
    <x-filament-widgets::widget>
        @livewire(\App\Filament\Widgets\YearlySurveyCount::class)
    </x-filament-widgets::widget>   
    <x-filament-widgets::widget>
        @livewire(\App\Filament\Widgets\FacilityMachinesCount::class)
    </x-filament-widgets::widget>   
    <x-filament-widgets::widget>
        @livewire(\App\Filament\Widgets\ModalityMachineCount::class)
    </x-filament-widgets::widget>   
    <x-filament-widgets::widget>
        @livewire(\App\Filament\Widgets\SurveyCategoryCount::class)
    </x-filament-widgets::widget>   
</x-filament-panels::page>
