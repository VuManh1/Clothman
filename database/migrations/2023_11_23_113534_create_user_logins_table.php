<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('provider_name', 50);
            $table->string('provider_key');
            $table->uuid('user_id');

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['provider_name', 'provider_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_logins');
    }
};
