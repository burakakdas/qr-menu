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
        Schema::create('branch_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Branch::class)->constrained();
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
            $table->decimal('price');
            $table->enum('currency', \App\Models\Enums\Currency::getValues());
            $table->boolean('is_active')->default(false);
            $table->foreignId('created_by_id')->constrained('users');
            $table->foreignId('updated_by_id')->nullable()->constrained('users');
            $table->foreignId('deleted_by_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_products');
    }
};
