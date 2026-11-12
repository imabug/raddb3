<?php

namespace App\Filament\Raddb\Pages;

use BackedEnum;
use App\Models\Machine;
use App\Models\TestDate;
use Filament\Pages\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
            ->record(
                function (): array {
                    $currSurveys = TestDate::without(['machine','testType'])
                        ->select('machine_id')
                        ->year(date('Y'))
                        ->get()
                        ->pluck('machine_id')
                        ->toArray();
                    $untested = Machine::active()
                        ->without([
                            'manufacturer',
                            'testDate',
                            'tube'])
                        ->noTestEquipment()
                        ->orderBy('description')
                        ->get()
                        ->whereNotIn('id', $currSurveys);
                }
            )
            // ->query(
            //     fn(): Builder => Machine::query()
            //         ->active()
            //         ->without([
            //             'manufacturer',
            //             'testDate',
            //             'tube'])
            //         ->whereNotIn('id', 
            //             fn(): array => TestDate::without(['machine','testType'])
            //                 ->select('machine_id')
            //                 ->year(date('Y'))
            //                 ->get()
            //                 ->toArray())
            //         ->orderBy('description')
            // )
            ->columns([
                Stack::make([
                    TextColumn::make('description'),
                    TextColumn::make('facility.facility'),
                    TextColumn::make('modality'),
                ])
            ])
            ->contentGrid([
                'md' => 3,
                'xl' => 4,
                '2xl' => 5,
            ])
            ->filters([
                SelectFilter::make('facility')
                    ->relationship('facility', 'facility'),
                SelectFilter::make('modality')
                    ->relationship('modality', 'modality'),
            ])
            ->deferFilters(false)
            ->groups([
                Group::make('facility.facility')
                    ->collapsible(),
                Group::make('modality.modality')
                    ->collapsible(),
            ])
            ->defaultGroup('facility.facility')
            ->paginated([10, 50, 100, 'all'])
            ->defaultPaginationPageOption(50)
            ->extremePaginationLinks()
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
