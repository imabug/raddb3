<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TubeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('machine_id')
                    ->relationship('machine', 'id')
                    ->required(),
                Select::make('housing_manuf_id')
                    ->relationship('housingManuf', 'id')
                    ->default(null),
                TextInput::make('housing_model')
                    ->default(null),
                TextInput::make('housing_sn')
                    ->default(null),
                Select::make('insert_manuf_id')
                    ->relationship('insertManuf', 'id')
                    ->default(null),
                TextInput::make('insert_model')
                    ->default(null),
                TextInput::make('insert_sn')
                    ->default(null),
                DatePicker::make('manuf_date')
                    ->format('Y-m-d')
                    ->displayFormat('Y-m-d'),
                DatePicker::make('install_date')
                    ->format('Y-m-d')
                    ->displayFormat('Y-m-d'),
                DatePicker::make('remove_date')
                    ->format('Y-m-d')
                    ->displayFormat('Y-m-d'),
                TextInput::make('lfs')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('mfs')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('sfs')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('tube_status')
                    ->options(Status::class)
                    ->default(Status::Active)
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
