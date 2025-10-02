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
        Schema::create('articles', function (Blueprint $table) {
             $table->id();
            $table->string('lang'); // en, fr, ar
            $table->string('article_title');
            $table->string('metatag')->nullable();
            $table->string('article_slug')->unique();
            $table->string('article_image')->nullable();
            $table->longText('content'); // This will store HTML from the rich text editor
            $table->boolean('show_on_home_page')->default(false);
            $table->unsignedBigInteger('menu_id')->nullable();

            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
