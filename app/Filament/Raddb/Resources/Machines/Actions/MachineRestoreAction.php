<?php

namespace App\Filament\Raddb\Resources\Machines\Actions;

use App\Enums\Status;
use App\Models\Tube;
use Filament\Actions\Action;
use Filament\Actions\RestoreAction;

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
        return RestoreAction::make()
            ->before(function ($record) {
                $record->machine_status = Status::Active;
                $record->remove_date = null;
                $record->save();
            })
            ->after(function ($record) {
                // Get the tubes associated with the machine
                $tubes = Tube::withTrashed()
                    ->where('machine_id', $record->id)
                    ->get();
                // Need to figure out how to restore the most recent tubes
                // for the machine
            });
    }
}
