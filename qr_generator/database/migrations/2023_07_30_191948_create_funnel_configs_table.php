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
            $table->integer('funnel_type_id');
            $table->date('work_started_at');
            $table->tinyInteger('is_actual')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_configs');
    }
};
