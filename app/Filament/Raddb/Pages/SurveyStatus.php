<?php

namespace App\Filament\Raddb\Pages;

use App\Models\Machine;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class SurveyStatus extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.raddb.pages.survey-status';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Machine::with([
                    'testDate' => function ($query) {
                        $query->where('test_type_id', 1)->orWhere('test_type_id', 2)->latest('test_date');
                    },
                ])->active()
            )
            ->columns([
                TextColumn::make('description')
                    ->label('Description'),
                TextColumn::make('test_date')
                    ->label('Survey Date'),
            ]);
    }
}
