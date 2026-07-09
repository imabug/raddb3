<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Database\Eloquent\Builder;

class MachineInfoSchema
{
    public static function make(): array
    {
        return [
            Section::make('Site information')
                ->schema([
                    Select::make('facility_id')
                        ->label('Facility')
                        ->relationship('facility', 'facility')
                        ->required()
                        ->live(),
                    Select::make('location_id')
                        ->label('Location')
                        ->relationship(
                            name: 'location',
                            titleAttribute: 'location',
                            modifyQueryUsing: fn(Builder $query, Get $get) => $query->where('facility_id', $get('facility_id')),
                        )
                        ->required(),
                    Textarea::make('description')
                        ->maxLength(255)
                        ->rows(1)
                        ->default(null),
                    TextInput::make('room')
                        ->string()
                        ->maxLength(20)
                        ->default(null),
                    Select::make('machine_status')
                        ->options(Status::class)
                        ->default(Status::Active)
                        ->required(),
                    DatePicker::make('install_date')
                        ->label('Install date')
                        ->format('Y-m-d')
                        ->displayFormat('Y-m-d')
                        ->default(null),
                    Textarea::make('notes')
                        ->default(null)
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('Machine information')
                ->schema([
                    Select::make('modality_id')
                        ->label('Modality')
                        ->relationship('modality', 'modality')
                        ->default(null),
                    Select::make('manufacturer_id')
                        ->label('Manufacturer')
                        ->relationship('manufacturer', 'manufacturer')
                        ->default(null),
                    Textarea::make('model')
                        ->string()
                        ->maxLength(100)
                        ->rows(1)
                        ->default(null),
                    Textarea::make('serial_number')
                        ->string()
                        ->maxLength(50)
                        ->rows(1)
                        ->default(null),
                    Textarea::make('vend_site_id')
                        ->label('Vendor site ID')
                        ->string()
                        ->maxLength(25)
                        ->rows(1)
                        ->default(null),
                    DatePicker::make('manuf_date')
                        ->label('Manufacture date')
                        ->format('Y-m-d')
                        ->displayFormat('Y-m-d')
                        ->default(null),
                    TextInput::make('software_version')
                        ->string()
                        ->maxLength(50)
                        ->default(null),
                    TextInput::make('pacs_station')
                        ->string()
                        ->maxLength(50)
                        ->default(null),
                ])
                ->columns(2),
        ];
    }
}
