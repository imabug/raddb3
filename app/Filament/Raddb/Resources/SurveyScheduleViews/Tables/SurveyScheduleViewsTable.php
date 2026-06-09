<?php

namespace App\Filament\Raddb\Resources\SurveyScheduleViews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SurveyScheduleViewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('prevSurveyId')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('prevSurveyDate')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('currSurveyId')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('currSurveyDate')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
