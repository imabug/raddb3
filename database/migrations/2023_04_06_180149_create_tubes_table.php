<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Machine;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tubes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Machine::class)->index();
            $table->string('housing_model', 50)->nullable();
            $table->string('housing_sn', 50)->nullable();
            $table->unsignedBigInteger('housing_manuf_id')->index();
            $table->string('insert_model', 50)->nullable();
            $table->string('insert_sn', 50)->nullable();
            $table->unsignedBigInteger('insert_manuf_id')->index();
            $table->decimal('lfs', $precision=2, $scale=1);
            $table->decimal('mfs', $precision=2, $scale=1);
            $table->decimal('sfs', $precision=2, $scale=1);
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
        Schema::dropIfExists('tubes');
    }
};
