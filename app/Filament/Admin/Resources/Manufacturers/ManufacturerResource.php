<?php

namespace App\Filament\Admin\Resources\Manufacturers;

use App\Filament\Admin\Resources\Manufacturers\Pages\CreateManufacturer;
use App\Filament\Admin\Resources\Manufacturers\Pages\EditManufacturer;
use App\Filament\Admin\Resources\Manufacturers\Pages\ListManufacturers;
use App\Filament\Admin\Resources\Manufacturers\Pages\ViewManufacturer;
use App\Filament\Admin\Resources\Manufacturers\Schemas\ManufacturerForm;
use App\Filament\Admin\Resources\Manufacturers\Schemas\ManufacturerInfolist;
use App\Filament\Admin\Resources\Manufacturers\Tables\ManufacturersTable;
use App\Models\Manufacturer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManufacturerResource extends Resource
{
    protected static ?string $model = Manufacturer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'Manufacturer';

    public static function form(Schema $schema): Schema
    {
        return ManufacturerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ManufacturerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ManufacturersTable::configure($table);
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
            'index' => ListManufacturers::route('/'),
            'create' => CreateManufacturer::route('/create'),
            'view' => ViewManufacturer::route('/{record}'),
            'edit' => EditManufacturer::route('/{record}/edit'),
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
