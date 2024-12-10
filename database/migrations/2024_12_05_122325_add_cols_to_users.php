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
            $table->string('rs_contact_number')->nullable();
            $table->float('rs_height')->nullable();
            $table->float('rs_weight')->nullable();
            $table->float('rs_initial_weight')->nullable();
            $table->unsignedTinyInteger('rs_age')->nullable();
            $table->string('rs_profile_image')->nullable();
            $table->string('rs_profile_image')->nullable();
            $table->boolean('rs_regular_period')->default(false);
            $table->date('rs_date_of_last_period')->nullable();
            $table->integer('rs_number_of_cycle_days')->nullable();
            $table->string('rs_street')->nullable();
            $table->string('rs_house')->nullable();
            $table->string('rs_apartment')->nullable();
            $table->string('rs_zipcode')->nullable();
            $table->string('rs_city')->nullable();
            $table->string('rs_personal_status')->nullable();
            $table->string('rs_occupation')->nullable();
            $table->string('rs_status')->default('active');
            $table->timestamp('rs_last_login')->nullable();
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
