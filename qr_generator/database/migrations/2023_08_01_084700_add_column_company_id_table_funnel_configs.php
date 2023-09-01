<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('funnel_configs', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');

            $table->foreign('company_id')->on('id')->references('companies');
        });
    }

    public function down(): void
    {
        Schema::table('funnel_configs', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
};
