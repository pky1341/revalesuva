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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->after('remember_token', function ($table) {
                    $table->string('contact_number')->nullable();
                    $table->string('user_name')->nullable();
                    $table->decimal('height',5,2)->nullable();
                    $table->boolean('is_active')->default(1);
                    $table->decimal('initial_weight',5,2)->nullable();
                    $table->date('date_of_birth')->nullable();
                    $table->string('profile_image')->nullable();
                    $table->string('regular_period')->nullable();
                    $table->date('date_of_last_period')->nullable();
                    $table->integer('number_of_cycle_days')->nullable();
                    $table->string('street')->nullable();
                    $table->string('house')->nullable();
                    $table->string('apartment')->nullable();
                    $table->integer('zipcode')->nullable();
                    $table->string('city')->nullable();
                    $table->string('personal_status')->nullable();
                    $table->string('occupation')->nullable();
                    $table->timestamp('last_login')->nullable();
                    $table->string('gender')->nullable();
                    $table->string('temporary_password')->nullable()->after('password');
                    $table->timestamp('temp_pwd_created_at')->nullable()->after('temporary_password');
                });
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['contact_number','user_name','height','status','initial_weight','date_of_birth','profile_image','regular_period','date_of_last_period','number_of_cycle_days','street','apartment','zipcode','city','personal_status','occupation','last_login','gender','temporary_password','temp_pwd_created_at']);
         });
    }
};
