<?php
use App\Models\Modality;

test('can create a new modality model', function () {

    $m = Modality::factory()->create();

    expect($m->id)->toBeNumeric();

});

test('can add a new modality', function () {
    $m = new Modality();
    $m->modality = 'Test Modality';
    $m->save();

    expect($m->modality)->toEqual('Test Modality');
});

test('can update a modality', function() {
    $m = Modality::factory()->create();

    $m->modality = 'Updated modality';
    $m->update();

    expect($m->modality)->toEqual('Updated modality');
});
