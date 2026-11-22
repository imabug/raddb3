<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Actions;

use App\Enums\Status;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;

class TubeDeleteAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function configure(): Action
    {
        return DeleteAction::make()
            ->before(function ($record) {
                // Set tube_status and remove_date before deleting the tube
                $record->tube_status = Status::Removed;
                $record->remove_date = now();
                $record->save();
            })
            ->successNotification(function ($record) {
                return Notification::make()
                    ->success()
                    ->title('Tube deleted')
                    ->body('Tube ID '.$record->id.' has been deleted.');
            });
    }

    public static function configureBulk(): BulkAction
    {
        return DeleteBulkAction::make();
    }
}
