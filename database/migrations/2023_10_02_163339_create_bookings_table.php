<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->integer('days')->comment('จำนวนวัน');
            $table->integer('status_id');
            $table->string('note')->nullable()->default(null);
            $table->string('cus_fname');
            $table->string('cus_lname');
            $table->string('cus_phone');
            $table->string('email');
            $table->string('line_id')->nullable()->default(null);
            $table->string('id_card')->comment('เลขปปช.4ตัวท้าย');
            $table->string('payment_type');
            $table->string('slip')->nullable()->default(null);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('bookings')->insert([
            [
                'id' => 1,
                'booking_id' => 'BK-1234',
                'room_id' => 1,
                'price' => 400,
                'date_checkin' => '2023-10-3',
                'date_checkout' => '2023-10-10',
                'days' => 7,
                'status_id' => 1,
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1234",
                'payment_type' => "transfer",
            ],
            [
                'id' => 2,
                'booking_id' => 'BK-1234',
                'room_id' => 2,
                'price' => 450,
                'date_checkin' => '2023-10-5',
                'date_checkout' => '2023-10-6',
                'days' => 1,
                'status_id' => 1,
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1234",
                'payment_type' => "transfer",
            ],
        ]);
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
