<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funnel_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funnel_config_id');
            $table->string('field_name');
            $table->string('operator');
            $table->integer('value')->nullable(true)->default(null);
            $table->integer('value_range_from')->nullable(true)->default(null);
            $table->integer('value_range_to')->nullable(true)->default(null);
            $table->integer('is_actual')->default(1);
            $table->timestamps();

            $table->foreign('funnel_config_id')->references('id')->on('funnel_configs');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_fields');
    }
};
