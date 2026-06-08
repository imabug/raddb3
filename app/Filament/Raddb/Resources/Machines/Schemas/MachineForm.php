<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class MachineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('facility_id')
                    ->label('Facility')
                    ->relationship('facility', titleAttribute:'facility')
                    ->required()
                    ->live(),
                Select::make('location_id')
                    ->label('Location')
                    ->relationship(
                        'location',
                        titleAttribute: 'location',
                        modifyQueryUsing: fn (Builder $query, Get $get) => $query->where('facility_id', $get('facility_id')),
                    )
                    ->required(),
                Textarea::make('description')
                    ->string()
                    ->maxLength(255)
                    ->default(null),
                Select::make('modality_id')
                    ->label('Modality')
                    ->relationship('modality', titleAttribute: 'modality')
                    ->required(),
                Select::make('manufacturer_id')
                    ->label('MManufacturer')
                    ->relationship('manufacturer', titleAttribute:'manufacturer')
                    ->required(),
                Textarea::make('model')
                    ->string()
                    ->maxLength(255)
                    ->default(null),
                Textarea::make('serial_number')
                    ->string()
                    ->maxLength(255)
                    ->default(null),
                Textarea::make('vend_site_id')
                    ->label('Vendor site ID')
                    ->string()
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('room')
                    ->string()
                    ->maxLength(20)
                    ->default(null),
                DatePicker::make('install_date')
                    ->label('Install date')
                    ->format('Y-m-d')
                    ->displayFormat('Y-m-d'),
                DatePicker::make('manuf_date')
                    ->label('Manufacture date')
                    ->format('Y-m-d')
                    ->displayFormat('Y-m-d'),
                DatePicker::make('remove_date')
                    ->label('Removal date')
                    ->format('Y-m-d')
                    ->displayFormat('Y-m-d'),
                Select::make('machine_status')
                    ->options(Status::class)
                    ->default(Status::Active)
                    ->required(),
                TextInput::make('software_version')
                    ->string()
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('pacs_station')
                    ->string()
                    ->maxLength(50)
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
