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
        Schema::create('invoice_customers', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('fee')->default(0);
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('quotation_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->boolean('is_paid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_customers');
    }
};
