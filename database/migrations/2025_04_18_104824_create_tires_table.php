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
        Schema::create('tires', function (Blueprint $table) {
            $table->id();
            $table->string('nr_article')->unique();  // Unique Product ID
            $table->integer('largeur');              // Width (205, 225, etc.)
            $table->integer('hauteur');              // Height (55, 65, etc.)
            $table->integer('diametre');             // Diameter (16, 17, etc.)
            $table->string('vitesse');               // Speed Rating (H, V)
            $table->string('marque');                // Brand (Michelin, Bridgestone)
            $table->string('profile');               // Tread Pattern
            $table->string('lot')->nullable();       // Batch Number
            $table->float('mm')->nullable();        // Tread Depth
            $table->string('dot')->nullable();      // DOT Code
            $table->boolean('rft')->default(false);  // Run-Flat Tire?
            $table->enum('saison', ['Summer', 'Winter', 'All-Season']);
            $table->integer('quantite');             // Quantity in Stock
            $table->decimal('prix_pro', 10, 2);      // Wholesale Price
            $table->decimal('prix', 10, 2);          // Retail Price
            $table->string('etat');                  // Condition (New/Used)
            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tires');
    }
};
