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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_state')->nullable()->change();
            $table->string('billing_state')->nullable()->change();
            $table->string('shipping_country')->nullable()->change();
            $table->string('billing_country')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_state')->nullable(false)->change();
            $table->string('billing_state')->nullable(false)->change();
            $table->string('shipping_country')->nullable(false)->change();
            $table->string('billing_country')->nullable(false)->change();
        });
    }
};
