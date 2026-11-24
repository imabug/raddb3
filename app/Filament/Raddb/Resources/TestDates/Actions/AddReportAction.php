<?php

namespace App\Filament\Raddb\Resources\TestDates\Actions;

use App\Filament\Schemas\AddReportForm;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class AddReportAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function make(): Action
    {
        return Action::make('addReport')
            ->iconButton()
            ->icon(Heroicon::OutlinedDocumentText)
            ->label('Add report')
            ->color('info')
            ->schema(AddReportForm::make())
            ->action();
    }
}
