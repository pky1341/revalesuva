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
        Schema::create('inquiry_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('help_question')->nullable();
            $table->text('help_details')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiry_service', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('user_id');
            $table->dropColumn('help_question');
            $table->dropColumn('help_details');
            $table->dropColumn('status');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
