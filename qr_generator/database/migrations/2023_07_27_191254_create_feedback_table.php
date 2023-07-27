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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('table_id');
            $table->integer('rating');
            $table->text('feedback_text');
            $table->text('feedback_user_name');
            $table->text('contact_data')->default(null)->nullable(true);
            $table->integer('is_actual')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
