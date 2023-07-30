<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funnel_types', function (Blueprint $table) {
            $table->id();
            $table->string('funnel_type_tag');
            $table->string('funnel_type_name');
            $table->tinyInteger('is_actual');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_types');
    }
};
