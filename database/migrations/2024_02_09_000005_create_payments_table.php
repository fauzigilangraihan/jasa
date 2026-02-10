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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();
            $table->foreignId('order_id')->constrained('orders');
            $table->enum('type', ['down_payment', 'full_payment'])->default('down_payment');
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'failed'])->default('pending');
            $table->string('payment_method')->nullable(); // e.g., 'transfer', 'card'
            $table->string('transaction_id')->nullable();
            $table->text('payment_proof_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
