<?php

namespace App\Filament\Raddb\Resources\Machines\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;

class MachineTubeSchema
{
    public static function make(): array
    {
        return [
            Section::make('Tube')
                ->schema([
                    Fieldset::make('Housing')
                    ->schema([
                        Select::make('housing_manuf_id')
                            ->label('Housing manufacturer')
                            ->relationship('manufacturer', 'manufacturer')
                            ->default(null),
                        TextInput::make('housing_model'),
                        TextInput::make('housing_sn'),
                    ]),
                    Fieldset::make('Insert')
                    ->schema([
                        Select::make('insert_manuf_id')
                            ->label('Insert anufacturer')
                            ->relationship('manufacturer', 'manufacturer')
                            ->default(null),
                        TextInput::make('insert_model'),
                        TextInput::make('insert_sn'),
                    ]),
                    TextInput::make('lfs')
                        ->label('Large focal spot size'),
                    TextInput::make('mfs')
                        ->label('Medium focal spot size'),
                    TextInput::make('sfs')
                        ->label('Small focal spot size'),
                    DatePicker::make('manuf_date')
                        ->label('Manufacture date')
                        ->format('Y-m-d')
                        ->displayFormat('Y-m-d')
                        ->default(null),
                    DatePicker::make('install_date')
                        ->label('Install date')
                        ->format('Y-m-d')
                        ->displayFormat('Y-m-d')
                        ->default(null),
                    Select::make('tube_status')
                        ->options(Status::class)
                        ->default(Status::Active)
                        ->required(),
                    Textarea::make('notes'),
                ])
                ->columns(2),
        ];
    }
}
