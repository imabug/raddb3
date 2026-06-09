<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews;

use App\Filament\Raddb\Resources\SurveyScheduleViews\Pages\CreateSurveyScheduleView;
use App\Filament\Raddb\Resources\SurveyScheduleViews\Pages\EditSurveyScheduleView;
use App\Filament\Raddb\Resources\SurveyScheduleViews\Pages\ListSurveyScheduleViews;
use App\Filament\Raddb\Resources\SurveyScheduleViews\Pages\ViewSurveyScheduleView;
use App\Filament\Raddb\Resources\SurveyScheduleViews\Schemas\SurveyScheduleViewForm;
use App\Filament\Raddb\Resources\SurveyScheduleViews\Schemas\SurveyScheduleViewInfolist;
use App\Filament\Raddb\Resources\SurveyScheduleViews\Tables\SurveyScheduleViewsTable;
use App\Models\SurveyScheduleView;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SurveyScheduleViewResource extends Resource
{
    protected static ?string $model = SurveyScheduleView::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SurveyScheduleViewForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SurveyScheduleViewInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SurveyScheduleViewsTable::configure($table);
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
            'index' => ListSurveyScheduleViews::route('/'),
            'create' => CreateSurveyScheduleView::route('/create'),
            'view' => ViewSurveyScheduleView::route('/{record}'),
            'edit' => EditSurveyScheduleView::route('/{record}/edit'),
        ];
    }
}
