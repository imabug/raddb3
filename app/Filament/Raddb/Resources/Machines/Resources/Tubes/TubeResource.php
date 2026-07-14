<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes;

use App\Filament\Raddb\Resources\Machines\MachineResource;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Pages\CreateTube;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Pages\EditTube;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Pages\ViewTube;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Schemas\TubeForm;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Schemas\TubeInfolist;
use App\Filament\Raddb\Resources\Machines\Resources\Tubes\Tables\TubesTable;
use App\Models\Tube;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TubeResource extends Resource
{
    protected static ?string $model = Tube::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = MachineResource::class;

    public static function form(Schema $schema): Schema
    {
        return TubeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TubeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TubesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateTube::route('/create'),
            'view' => ViewTube::route('/{record}'),
            'edit' => EditTube::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
