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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("invoice_id")->constrained();
            $table->foreignId("payment_method_id")->constrained();
            $table->double("amount");
            $table->string("fee")->nullable();
            $table->string("total_amount");
            $table->string("status")->default(0);
            $table->string("status_operator")->default(0);
            $table->string("reference_operateur")->nullable();
            $table->string("memo")->nullable();
            $table->string("reference_transaction")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
