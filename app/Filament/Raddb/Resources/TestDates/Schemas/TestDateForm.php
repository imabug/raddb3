<?php

namespace App\Filament\Raddb\Resources\TestDates\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TestDateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('machine_id')
                    ->label('Machine')
                    ->relationship(
                        name: 'machine',
                        titleAttribute: 'description',
                        modifyQueryUsing: fn(Builder $query) => $query->active(),
                    )
                    ->searchable()
                    ->noSearchResultsMessage('No machines found')
                    ->searchPrompt('Search by machine description')
                    ->preload()
                    ->required(),
                Select::make('test_type_id')
                    ->label('Test type')
                    ->relationship(
                        name: 'testType',
                        titleAttribute: 'test_type',
                    )
                    ->default(1) // Would prefer to not hardcode this
                    ->required(),
                DateTimePicker::make('test_date')
                    ->label('Survey date')
                    ->format('Y-m-d H:i')
                    ->displayFormat('Y-m-d H:i')
                    ->seconds(false)
                    ->required(),
                TextInput::make('accession')
                    ->string()
                    ->maxLength(50)
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
