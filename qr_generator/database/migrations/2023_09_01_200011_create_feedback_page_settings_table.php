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
        Schema::create('feedback_page_settings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('text');
            $table->boolean('show_company_info')->default(false);
            $table->text('page_type');
            $table->unsignedBigInteger('company_id');
            $table->tinyInteger('is_actual')->default(1);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_page_settings');
    }
};
