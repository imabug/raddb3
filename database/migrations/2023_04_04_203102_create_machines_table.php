<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\Modality;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Modality::class)->index();
            $table->foreignIdFor(Manufacturer::class)->index();
            $table->foreignIdFor(Location::class)->index();
            $table->string('description', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->string('vendor_site_id', 50)->nullable();
            $table->string('room', 50)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Removed'])->index();
            $table->date('manuf_date')->nullable();
            $table->date('install_date')->nullable();
            $table->date('remove_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
