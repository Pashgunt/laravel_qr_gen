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
        Schema::create('page_setting_links', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('link_title');
            $table->unsignedBigInteger('page_setting_id');
            $table->tinyInteger('is_actual')->default(1);
            $table->timestamps();

            $table->foreign('page_setting_id')->references('id')->on('feedback_page_settings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_setting_links');
    }
};
