<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('current_level')->default('Pemula'); // e.g. "Pemula", "Senior", "HBA Pemula (Tahap 2)"
            $table->integer('progress_percent')->default(0);
            $table->json('skills')->nullable(); // Stores array of skills like [{name: 'Bonding', status: 'checked'}, ...]
            $table->date('next_schedule_date')->nullable();
            $table->time('next_schedule_time')->nullable();
            $table->string('coach_name')->nullable();
            $table->text('instructor_note')->nullable();
            $table->date('note_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
