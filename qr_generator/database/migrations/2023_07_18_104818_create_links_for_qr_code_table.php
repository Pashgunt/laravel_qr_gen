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
        Schema::create('links_for_qr_code', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_hash_id');
            $table->text('link');
            $table->integer('is_actual')->default(1)->nullable(false);
            $table->timestamps();

            $table->foreign('company_hash_id')->references('id')->on('company_table_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links_for_qr_code');
    }
};
