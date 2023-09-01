<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funnel_logic_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funnel_field_id');
            $table->string('logic_operator');
            $table->timestamps();

            $table->foreign('funnel_field_id')->references('id')->on('funnel_fields');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_logic_blocks');
    }
};
