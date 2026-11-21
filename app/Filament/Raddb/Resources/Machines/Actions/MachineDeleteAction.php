<?php

namespace App\Filament\Raddb\Resources\Machines\Actions;

use App\Enums\Status;
use App\Models\Tube;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;

class MachineDeleteAction
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
                // Set the machine status before saving
                $record->machine_status = Status::Removed;
                $record->remove_date = now();
                $record->save();
            })
            ->after(function ($record) {
                // Find any tubes associated with the machine and delete them
                $tubes = Tube::active()
                    ->where('machine_id', $record->id)
                    ->get();
                foreach ($tubes as $t) {
                    $t->tube_status = Status::Removed;
                    $t->remove_date = now();
                    $t->save();
                    $t->delete();
                }
            });
    }
}
