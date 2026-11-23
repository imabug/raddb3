<?php

namespace App\Filament\Raddb\Resources\Machines\RelationManagers;

use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Schemas\TubeForm;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Tables\TubesTable;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\TubeResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TubeRelationManager extends RelationManager
{
    protected static string $relationship = 'tube';

    protected static ?string $relatedResource = TubeResource::class;

    public function form(Schema $schema): Schema
    {
        return TubeForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return TubesTable::configure($table);
    }
}
