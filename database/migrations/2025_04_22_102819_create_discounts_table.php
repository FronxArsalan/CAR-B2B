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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tire_id')->constrained()->onDelete('cascade');
            $table->decimal('min_quantity')->default(1);
            $table->decimal('discount_percent', 5, 2)->default(0); // e.g. 10 = 10%
            $table->enum('type', ['general', 'seasonal'])->default('general');
            $table->string('season')->nullable(); // e.g. Winter
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
