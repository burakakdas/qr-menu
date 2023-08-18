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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('domain')->nullable();
            $table->string('slogan')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->json('settings');
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(false);
            $table->foreignId('created_by_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('companies');
    }
};
