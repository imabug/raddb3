<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Machine;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMachineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        // Set the machine status
        $machine->machine_status = Status::Removed;
        $machine->remove_date = date('Y-m-d');
        $machine->save();

        // Get the tubes associated with $machine
        $tubes = $machine->tube->where('tube_status', Status::Active);
        foreach ($tubes as $t) {
            $t->tube_status = Status::Removed;
            $t->remove_date = date('Y-m-d');
            $t->save();
            $t->delete();
        }

        $machine->delete();
    }
}
