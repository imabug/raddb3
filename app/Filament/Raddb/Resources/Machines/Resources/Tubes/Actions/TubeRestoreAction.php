<?php

namespace App\Filament\Raddb\Resources\Machines\Resources\Tubes\Actions;

use App\Enums\Status;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

class TubeRestoreAction
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
        return RestoreAction::make()
            ->before(function ($record) {
                // Update tube_status and remove_date before restoring
                $record->tube_status = Status::Active;
                $record->remove_date = null;
                $record->save();
            })
            ->successNotification(function ($record) {
                return Notification::make()
                    ->success()
                    ->title('Tube restored')
                    ->body('Tube ID '.$record->id.' has been restored.');
            });
    }

    public static function configureBulk(): BulkAction
    {
        return RestoreBulkAction::make()
            ->before(function (Collection $records) {
                // Update tube_status and remove_date before restoring
                foreach ($records as $r) {
                    $r->tube_status = Status::Active;
                    $r->remove_date = null;
                    $r->save();
                }
            })
            ->successNotificationTitle('Tubes restored.');
    }
}
