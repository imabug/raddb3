<?php

namespace App\Console\Commands;

use App\Models\Machine;
use App\Models\OpNote;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('raddb:conv-op-note')]
#[Description('Convert operational notes to JSON')]
class ConvOpNote extends Command
{
    /**
     * Artisan CLI command to take operation notes in the
     * op_notes table and convert them to JSON that will
     * be stored in the op_notes column in the machines table.
     */
    public function handle()
    {
        $machines = Machine::get();

        foreach ($machines as $m) {
            if ($m->opnote->count() > 0) {
                $m->op_notes = $m->opnote
                                   ->map(
                                       function (OpNote $item) {
                                           return ['note' => $item->note,];
                                       });
                $this->info('Opnotes for machine ' . $m->description . ' converted');
                $m->save();
            }
        }
    }
}
