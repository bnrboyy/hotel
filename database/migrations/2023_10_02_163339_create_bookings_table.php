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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->integer('room_id');
            $table->integer('price');
            $table->date('date_checkin');
            $table->date('date_checkout');
            $table->string('cus_fname');
            $table->string('cus_lname');
            $table->string('cus_phone');
            $table->string('email');
            $table->string('line_id')->nullable();
            $table->string('id_card')->comment('เลขปปช.4ตัวท้าย');
            $table->dateTime('time_book');
            $table->string('payment_type');
            $table->string('slip')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
