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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->bigInteger('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->double('amount');
            $table->enum('payment_method',config('constants.payment_methods'))->nullable();
            $table->dateTime('transaction_started_at')->nullable();
            $table->enum('payment_status',config('constants.payment_status'))->default(config('constants.payment_status.pending'));
            $table->string('product_code')->nullable();
            $table->dateTime('transaction_ended_at')->nullable();
            $table->string('transaction_signature')->nullable();
            $table->string('transaction_code')->nullable();
            $table->string('transaction_uuid')->nullable();
            $table->string('check_in_date')->nullable();
            $table->string('check_out_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
