<?php

namespace App\Filament\Reports\Pages;

use App\Models\Machine;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestEquipCal extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.reports.pages.test-equip-cal';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    public static function table(Table $table): Table
    {
        return $table
            ->lazyLoaded(true)
            ->query(fn(): Builder => Machine::query()->active()
                ->testEquipment()
                ->without([
                    'facility',
                    'location',
                    'modality',
                ])
                ->with([
                    // Get the test dates through the testDate relationship
                    'testDate' => function ($query) {
                        $query->without('machine')
                            ->where('test_type_id', '10')
                            ->latest('test_date');
                    },
                ]))
            ->columns([
                TextColumn::make('description')
                    ->label('description'),
                TextColumn::make('testDate.test_date')
                    ->label('Calibration date')
                    ->date('Y-m-d')
                    ->listWithLineBreaks(true)
                    ->limitList(1)
                    ->expandableLimitedList(true),
            ])
            ->defaultSort('description', direction: 'asc');
    }
}
