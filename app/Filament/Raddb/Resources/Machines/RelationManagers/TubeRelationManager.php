<?php

namespace App\Filament\Raddb\Resources\Machines\RelationManagers;

use App\Enums\Status;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TubeRelationManager extends RelationManager
{
    protected static string $relationship = 'tube';

    protected static ?string $relatedResource = TubeResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Housing')
                ->schema([
                    Select::make('housing_manuf_id')
                        ->label('Housing manufacturer')
                        ->relationship('housingManuf', 'manufacturer')
                        ->default(null),
                    TextInput::make('housing_model'),
                    TextInput::make('housing_sn'),
                ]),
                Fieldset::make('Insert')
                ->schema([
                    Select::make('insert_manuf_id')
                        ->label('Insert Manufacturer')
                        ->relationship('insertManuf', 'manufacturer')
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

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
