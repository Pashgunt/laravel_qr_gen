<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funnel_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funnel_type_id');
            $table->date('work_started_at');
            $table->tinyInteger('is_actual')->default(1);
            $table->timestamps();

            $table->foreign('funnel_type_id')->references('id')->on('funnel_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_configs');
    }
};
