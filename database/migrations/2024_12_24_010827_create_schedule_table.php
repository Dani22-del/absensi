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
        Schema::create('schedule', function (Blueprint $table) {
            $table->bigIncrements('id_schedule');
            $table->integer('sales_id'); 
            $table->integer('customer_id');
            $table->date('tanggal_jadwal'); 
            $table->enum('status', ['hadir', 'reschedule','batal']); 
            $table->string('photo_path')->nullable(); 
            $table->string('file_path')->nullable();  
            $table->text('description')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
