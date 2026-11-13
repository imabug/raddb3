<?php

namespace App\Filament\Raddb\Pages;

use BackedEnum;
use App\Models\Machine;
use App\Models\TestDate;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use UnitEnum;

class Untested extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static string|UnitEnum|null $navigationGroup = 'Surveys';
    protected string $view = 'filament.raddb.pages.untested';

    public static function table(Table $table): Table
    {
        return $table
            ->lazyLoaded()
            ->heading('Untested machines')
            ->records(
                function (): array {
                    $currSurveys = TestDate::without(['machine','testType'])
                        ->year(date('Y'))
                        ->activeMachines()
                        ->get()
                        ->pluck('machine_id')
                        ->toArray();
                    $untested = Machine::without([
                            'manufacturer',
                            'testDate',
                            'tube'])
                        ->active()
                        ->noTestEquipment()
                        ->get()
                        ->withoutAppends()
                        ->whereNotIn('id', $currSurveys)
                        ->toArray();
                    return $untested;
                }
            )
            ->columns([
                Stack::make([
                    TextColumn::make('description'),
                    TextColumn::make('facility.facility'),
                    TextColumn::make('modality.modality'),
                ])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
                '2xl' => 4,
            ])
            ->paginated([10, 50, 100, 'all'])
            ->defaultPaginationPageOption(50)
            ->extremePaginationLinks()
            ->headerActions([
                //
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }
}
