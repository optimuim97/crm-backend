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
        Schema::create('c', function (Blueprint $table) {
            $table->id();
            $table->string('internal_reference');
            $table->string('provider_reference')->nullable();
            $table->string('barcode')->nullable();
            $table->string('designation');
            $table->string('quantity')->nullable();
            $table->decimal('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
