<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use App\Filament\Infolists\Components\SurveyReportEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class MachineInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Site information')
                        ->inlineLabel()
                        ->schema([
                            TextEntry::make('id')
                                ->label('Machine ID: '),
                            TextEntry::make('facility.facility')
                                ->label('Facility: ')
                                ->placeholder('-'),
                            TextEntry::make('location.location')
                                ->label('Location: ')
                                ->placeholder('-'),
                            TextEntry::make('room')
                                ->label('Room: ')
                                ->placeholder('-'),
                            TextEntry::make('install_date')
                                ->label('Install date: ')
                                ->date('Y-m-d')
                                ->placeholder('-'),
                            TextEntry::make('remove_date')
                                ->label('Removal date: ')
                                ->date('Y-m-d')
                                ->placeholder('-')
                                ->visible(fn(Get $get): bool => ($get('machine_status') == 'Active') ? true : false),
                            TextEntry::make('machine_status')
                                ->label('Status: ')
                                ->badge()
                                ->placeholder('-'),
                            TextEntry::make('software_version')
                                ->label('Software version: ')
                                ->placeholder('-'),
                            TextEntry::make('pacs_station')
                                ->label('PACS station: ')
                                ->placeholder('-'),
                            TextEntry::make('notes')
                                ->label('Notes: ')
                                ->placeholder('-')
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
                    Tab::make('Machine information')
                        ->inlineLabel()
                        ->schema([
                            TextEntry::make('manufacturer.manufacturer')
                                ->label('Manufacturer: ')
                                ->placeholder('-'),
                            TextEntry::make('modality.modality')
                                ->label('Modality: ')
                                ->placeholder('-'),
                            TextEntry::make('model')
                                ->label('Model: ')
                                ->placeholder('-'),
                            TextEntry::make('serial_number')
                                ->label('Serial #: ')
                                ->placeholder('-'),
                            TextEntry::make('vend_site_id')
                                ->label('Vendor site ID: ')
                                ->placeholder('-'),
                            TextEntry::make('manuf_date')
                                ->label('Manufacture date: ')
                                ->date('Y-m-d')
                                ->placeholder('-'),
                            TextEntry::make('age')
                                ->label('Age (years): ')
                                ->placeholder('-'),
                        ])
                        ->columns(2),
                    Tab::make('X-ray Tube')
                        ->schema([
                            RepeatableEntry::make('tube')
                                ->hiddenLabel()
                                ->schema([
                                    TextEntry::make('id')
                                        ->label('Tube ID')
                                        ->placeholder('-'),
                                    TextEntry::make('housingManuf.manufacturer')
                                        ->label('Housing Manufacturer')
                                        ->placeholder('-'),
                                    TextEntry::make('housing_model')
                                        ->label('Housing Model')
                                        ->placeholder('-'),
                                    TextEntry::make('housing_sn')
                                        ->label('Housing SN')
                                        ->placeholder('-'),
                                    TextEntry::make('insertManuf.manufacturer')
                                        ->label('Insert Manufacturer')
                                        ->placeholder('-'),
                                    TextEntry::make('insert_model')
                                        ->label('Insert model')
                                        ->placeholder('-'),
                                    TextEntry::make('insert_sn')
                                        ->label('Insert SN')
                                        ->placeholder('-'),
                                    TextEntry::make('manuf_date')
                                        ->label('Manufacture date')
                                        ->date('Y-m-d')
                                        ->placeholder('-'),
                                    TextEntry::make('install_date')
                                        ->label('Install date')
                                        ->date('Y-m-d')
                                        ->placeholder('-'),
                                    TextEntry::make('lfs')
                                        ->label('Large FS (mm)')
                                        ->placeholder('-'),
                                    TextEntry::make('mfs')
                                        ->label('Med FS (mm)')
                                        ->placeholder('-'),
                                    TextEntry::make('sfs')
                                        ->label('Small FS (mm)')
                                        ->placeholder('-'),
                                    TextEntry::make('notes')
                                        ->placeholder('-')
                                        ->columnSpanFull(),
                                ])
                                ->columns(4),
                        ])
                        ->columnSpanFull(),
                    Tab::make('Operational Notes')
                        ->schema([
                            RepeatableEntry::make('op_notes')
                                ->hiddenLabel()
                                ->schema([
                                    TextEntry::make('note')
                                        ->hiddenLabel(),
                                ])
                                ->grid(2),
                        ])
                        ->columnSpanFull(),
                    Tab::make('Surveys')
                        ->schema([
                            RepeatableEntry::make('testDate')
                                ->hiddenLabel()
                                ->table([
                                    TableColumn::make('Survey ID'),
                                    TableColumn::make('Survey date'),
                                    TableColumn::make('Test type'),
                                    TableColumn::make('Accession'),
                                    TableColumn::make('Notes'),
                                ])
                                ->schema([
                                    TextEntry::make('id'),
                                    TextEntry::make('test_date')
                                        ->date('Y-m-d'),
                                    TextEntry::make('testType.test_type')
                                        ->wrap(false),
                                    TextEntry::make('accession')
                                        ->beforeContent(SurveyReportEntry::make('surveyReport')),
                                    TextEntry::make('notes')
                                        ->wrap(),
                                ]),
                        ])
                        ->columnSpanFull(),
                        ])
            ]);
    }
}
