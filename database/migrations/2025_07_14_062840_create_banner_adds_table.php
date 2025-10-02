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
        Schema::create('banner_adds', function (Blueprint $table) {
            $table->id();

            $table->integer('ad_type')->unsigned()->default(1);
            $table->text('ad_url');
            $table->text('ad_text');
            $table->text('ad_link');
            $table->boolean('en')->unsigned();
            $table->boolean('fr')->unsigned();
            $table->boolean('ar')->unsigned();
            $table->integer('ad_clicks')->unsigned()->default(0);
            $table->boolean('ad_status')->unsigned()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_adds');
    }
};
