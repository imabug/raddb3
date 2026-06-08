<?php

namespace App\Filament\Admin\Resources\Facilities;

use App\Filament\Admin\Resources\Facilities\Pages\CreateFacility;
use App\Filament\Admin\Resources\Facilities\Pages\EditFacility;
use App\Filament\Admin\Resources\Facilities\Pages\ListFacilities;
use App\Filament\Admin\Resources\Facilities\Pages\ViewFacility;
use App\Filament\Admin\Resources\Facilities\Schemas\FacilityForm;
use App\Filament\Admin\Resources\Facilities\Schemas\FacilityInfolist;
use App\Filament\Admin\Resources\Facilities\Tables\FacilitiesTable;
use App\Models\Facility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'Facility';

    public static function form(Schema $schema): Schema
    {
        return FacilityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FacilityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacilitiesTable::configure($table);
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
            'index' => ListFacilities::route('/'),
            'create' => CreateFacility::route('/create'),
            'view' => ViewFacility::route('/{record}'),
            'edit' => EditFacility::route('/{record}/edit'),
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
