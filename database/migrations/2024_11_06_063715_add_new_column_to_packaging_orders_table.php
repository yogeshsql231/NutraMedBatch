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
        Schema::table('packaging_orders', function (Blueprint $table) {

            $table->json('indexSetting')->nullable();
            $table->json('testSerial')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packaging_orders', function (Blueprint $table) {
            $table->dropColumn('indexSetting');
            $table->dropColumn('testSerial');
        });
    }
};
