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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('en_title')->nullable();
            $table->text('en_value')->nullable();
            $table->string('fr_title')->nullable();
            $table->text('fr_value')->nullable();
            $table->string('ar_title')->nullable();
            $table->text('ar_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
