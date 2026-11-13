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
                    // Get the machine_ids that have current surveys
                    $currSurveys = TestDate::without([
                            'machine',
                            'testType',
                        ]) // Exclude these eager loaded relationships
                        ->year(date('Y')) // Limit records to the current year
                        ->activeMachines() // Only active machines
                        ->get()
                        ->pluck('machine_id') // Only get the machine_id
                        ->toArray();
                    // Get an array of machines that don't have current surveys
                    $untested = Machine::without([
                            'manufacturer',
                            'testDate',
                            'tube',
                        ]) // Exclude these eager loaded relationships
                        ->active() // Only active machines
                        ->noTestEquipment() // Exclude test equipment
                        ->whereNotIn('id', $currSurveys) // Exclude machine IDs in $currSurveys
                        ->get()
                        ->withoutAppends() // Don't include accessor attributes in the results
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
