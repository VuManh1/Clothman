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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->uuid('payment_id');
            $table->string('code')->unique();
            $table->enum('status', [
                'PENDING', 
                'PROCESSING', 
                'SHIPPING', 
                'CANCELED',
                'COMPLETED'
            ])->default('PENDING');
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone_number', 50);
            $table->text('address');
            $table->integer('total');
            $table->string('cancel_reason')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('payment_id')->references('id')->on('payments')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
