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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rs_weight');
            $table->string('rs_regular_period')->nullable()->change();
            $table->unsignedTinyInteger('rs_number_of_cycle_days')->nullable()->change();
            $table->integer('rs_zipcode')->nullable()->change();
            $table->dropColumn('rs_status');
            $table->boolean('rs_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
