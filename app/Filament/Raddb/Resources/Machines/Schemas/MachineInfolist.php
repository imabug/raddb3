<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use App\Filament\Schemas\Components\MachineSurveyList;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class MachineInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Site information')
                    ->schema([
                        TextEntry::make('facility.facility')
                            ->label('Facility')
                            ->placeholder('-'),
                        TextEntry::make('location.location')
                            ->label('Location')
                            ->placeholder('-'),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('room')
                            ->placeholder('-'),
                        TextEntry::make('install_date')
                            ->date()
                            ->placeholder('-'),
                        TextEntry::make('remove_date')
                            ->date()
                            ->placeholder('-')
                            ->visible(fn(Get $get): bool => ($get('machine_status') == 'Active') ? true : false),
                        TextEntry::make('machine_status')
                            ->badge()
                            ->placeholder('-'),
                        TextEntry::make('software_version')
                            ->placeholder('-'),
                        TextEntry::make('pacs_station')
                            ->placeholder('-'),
                        TextEntry::make('age')
                            ->label('Age (years)')
                            ->placeholder('-'),
                        TextEntry::make('notes')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Machine information')
                    ->schema([
                        TextEntry::make('manufacturer.manufacturer')
                            ->label('Manufacturer')
                            ->placeholder('-'),
                        TextEntry::make('modality.modality')
                            ->label('Modality')
                            ->placeholder('-'),
                        TextEntry::make('model')
                            ->placeholder('-'),
                        TextEntry::make('serial_number')
                            ->placeholder('-'),
                        TextEntry::make('vend_site_id')
                            ->label('Vendor site ID')
                            ->placeholder('-'),
                        TextEntry::make('manuf_date')
                            ->label('Manufacture date')
                            ->date()
                            ->placeholder('-'),
                    ])
                    ->columns(2),
                Section::make('Operational notes')
                    ->schema([
                        RepeatableEntry::make('Operational notes')
                            ->schema([
                            ]),
                    ]),
                Section::make('Surveys')
                    ->schema([
                        RepeatableEntry::make('Surveys')
                            ->table([
                                TableColumn::make('Survey ID'),
                                TableColumn::make('Survey date'),
                                TableColumn::make('Test type'),
                                TableColumn::make('Accession'),
                                TableColumn::make('Notes'),
                            ])
                            ->schema([
                                TextEntry::make('testDate.id'),
                                TextEntry::make('testDate.test_date'),
                                TextEntry::make('testDate.testType.test_type'),
                                TextEntry::make('testDate.accession'),
                                TextEntry::make('testDate.notes'),
                            ]),
                        // MachineSurveyList::make(),
                    ]),
            ]);
    }
}
