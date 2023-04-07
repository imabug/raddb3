<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Machine;
use App\Models\TestType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Machine::class)->index();
            $table->foreignIdFor(TestType::class);
            $table->unsignedBigInteger('tester1_id');
            $table->unsignedBigInteger('tester2_id');
            $table->text('notes')->nullable();
            $table->string('accession', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_dates');
    }
};
