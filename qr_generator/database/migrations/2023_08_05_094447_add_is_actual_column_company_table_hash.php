<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_table_hash', function (Blueprint $table) {
            $table->tinyInteger('is_actual')->default(1);
        });
    }
    
    public function down(): void
    {
        Schema::table('company_table_hash', function (Blueprint $table) {
            $table->dropColumn('is_actual');
        });
    }
};
