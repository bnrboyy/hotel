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
            $table->text('booking_date')->comment('วันที่เข้าพักทั้งหมด');
            $table->integer('days')->comment('จำนวนวัน');
            $table->integer('status_id');
            $table->string('booking_type')->nullable()->default(null)->comment('รูปแบบการจอง(online, walk-in)');
            $table->string('cus_fname');
            $table->string('cus_lname');
            $table->string('cus_phone');
            $table->string('email');
            $table->string('note')->nullable()->default(null);
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
                'date_checkout' => '2023-10-9',
                'booking_date' => '2023-10-03,2023-10-04,2023-10-05,2023-10-06,2023-10-07,2023-10-08',
                'days' => 6,
                'status_id' => 2,
                'booking_type' => 'online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1234",
                'payment_type' => "transfer",
            ],
            [
                'id' => 2,
                'booking_id' => 'BK-1235',
                'room_id' => 2,
                'price' => 450,
                'date_checkin' => '2023-10-5',
                'date_checkout' => '2023-10-6',
                'booking_date' => '2023-10-05',
                'days' => 1,
                'status_id' => 1,
                'booking_type' => 'online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1235",
                'payment_type' => "transfer",
            ],
            [
                'id' => 3,
                'booking_id' => 'BK-1236',
                'room_id' => 2,
                'price' => 450,
                'date_checkin' => '2023-10-6',
                'date_checkout' => '2023-10-8',
                'booking_date' => '2023-10-06,2023-10-07',
                'days' => 2,
                'status_id' => 1,
                'booking_type' => 'online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1236",
                'payment_type' => "transfer",
            ],
            [
                'id' => 4,
                'booking_id' => 'BK-1237',
                'room_id' => 1,
                'price' => 450,
                'date_checkin' => '2023-10-10',
                'date_checkout' => '2023-10-11',
                'booking_date' => '2023-10-10',
                'days' => 1,
                'status_id' => 1,
                'booking_type' => 'online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1237",
                'payment_type' => "transfer",
            ],
            [
                'id' => 5,
                'booking_id' => 'BK-1238',
                'room_id' => 3,
                'price' => 550,
                'date_checkin' => '2023-10-10',
                'date_checkout' => '2023-10-11',
                'booking_date' => '2023-10-10',
                'days' => 1,
                'status_id' => 1,
                'booking_type' => 'online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'id_card' => "1238",
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
