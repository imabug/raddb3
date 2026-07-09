<?php

namespace App\Filament\Raddb\Resources\Machines\RelationManagers;

use App\Filament\Raddb\Resources\Machines\MachineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class TubeRelationManager extends RelationManager
{
    protected static string $relationship = 'tube';

    protected static ?string $relatedResource = MachineResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
