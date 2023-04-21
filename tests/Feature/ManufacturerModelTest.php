<?php
use App\Models\Manufacturer;

test('can create a new Manufacturer model', function () {

    $m = Manufacturer::factory()->create();

    expect($m->id)->toBeNumeric();

});

test('can add a new manufacturer', function () {
    $m = new Manufacturer();
    $m->manufacturer = 'Test manufacturer';
    $m->save();

    expect($m->manufacturer)->toEqual('Test manufacturer');
});

test('can update a manufacturer', function() {
    $m = Manufacturer::factory()->create();

    $m->manufacturer = 'Updated manufacturer';
    $m->update();

    expect($m->manufacturer)->toEqual('Updated manufacturer');
});
