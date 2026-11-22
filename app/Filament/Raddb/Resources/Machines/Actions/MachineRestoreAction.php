<?php

namespace App\Filament\Raddb\Resources\Machines\Actions;

use App\Enums\Status;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;

class MachineRestoreAction
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
        /**
         * TODO: Figure out how to restore the most recent tubes
         * associated with the machine.
         */
        return RestoreAction::make()
            ->before(function ($record) {
                // Update machine_status and remove_date before restoring
                $record->machine_status = Status::Active;
                $record->remove_date = null;
                $record->save();
            })
            ->successNotification(function ($record) {
                return Notification::make()
                    ->success()
                    ->title('Machine restored')
                    ->body($record->description.' has been restored.');
            });
    }

    public static function configureBulk(): BulkAction
    {
        return RestoreBulkAction::make();
    }
}
