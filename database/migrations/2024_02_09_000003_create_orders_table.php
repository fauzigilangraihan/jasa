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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('pricing_package_id')->constrained('pricing_packages');
            $table->string('project_name');
            $table->text('project_description');
            $table->enum('status', ['pending', 'in_progress', 'revision', 'completed'])->default('pending');
            $table->dateTime('delivery_date')->nullable();
            $table->text('requirements')->nullable(); // JSON
            $table->decimal('total_price', 12, 2);
            $table->decimal('down_payment', 12, 2)->nullable();
            $table->boolean('payment_verified')->default(false);
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
