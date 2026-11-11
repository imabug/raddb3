<?php

namespace App\Filament\Reports\Pages;

use App\Models\Machine;
use Filament\Pages\Page;
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
                    // Get the most recent test date through the testDate relationship
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
                    ->label('Calibration date'),
            ])
            ->groups([
                Group::make('description')
                    ->collapsible(),
            ]);
    }
}
