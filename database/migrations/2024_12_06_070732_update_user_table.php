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
            $table->renameColumn('rs_contact_number','contact_number');
            $table->renameColumn('rs_height','height');
            $table->renameColumn('rs_initial_weight','initial_weight');
            $table->renameColumn('rs_age','age');
            $table->renameColumn('rs_profile_image','profile_image');
            $table->renameColumn('rs_regular_period','regular_period');
            $table->renameColumn('rs_date_of_last_period','date_of_last_period');
            $table->renameColumn('rs_number_of_cycle_days','number_of_cycle_days');
            $table->renameColumn('rs_street','street');
            $table->renameColumn('rs_house','house');
            $table->renameColumn('rs_apartment','apartment');
            $table->renameColumn('rs_zipcode','zipcode');
            $table->renameColumn('rs_city','city');
            $table->renameColumn('rs_personal_status','personal_status');
            $table->renameColumn('rs_occupation','occupation');
            $table->renameColumn('rs_status','status');
            $table->renameColumn('rs_last_login','last_login');
            $table->renameColumn('rs_gender','gender');
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
