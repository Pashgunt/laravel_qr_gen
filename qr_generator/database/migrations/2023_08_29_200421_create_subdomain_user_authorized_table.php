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
        Schema::create('subdomain_user_authorized', function (Blueprint $table) {
            $table->id();
            $table->string('subdomain');
            $table->string('email');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('is_actual')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdomain_user_authorized');
    }
};
