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
            $table->string('first_name_order');
            $table->string('last_name_order');
            $table->string('address_1_order');
            $table->string('address_2_order');
            $table->string('postal_code_order');
            $table->string('phone_order');
            $table->string('email_order');
            $table->text('additional_data_order');
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
