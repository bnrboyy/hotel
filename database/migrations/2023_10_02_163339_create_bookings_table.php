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
            $table->string('booking_number')->unique();
            $table->integer('room_id');
            $table->integer('price_per_date')->nullable()->default(null);
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
            $table->string('card_id')->comment('เลขปปช.4ตัวท้าย');
            $table->string('payment_type');
            $table->string('slip')->nullable()->default(null);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('bookings')->insert([
            [
                'id' => 1,
                'booking_number' => 'BK-0001',
                'room_id' => 1,
                'price' => 2400,
                'price_per_date' => 400,
                'date_checkin' => '2023-11-16',
                'date_checkout' => '2023-11-22',
                'booking_date' => '2023-11-16,2023-11-17,2023-11-18,2023-11-19,2023-11-20,2023-11-21',
                'days' => 6,
                'status_id' => 3,
                'booking_type' => 'Online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'card_id' => "1234",
                'payment_type' => "transfer",
                'slip' => '/images/bank/k-bankqr.png',
            ],
            [
                'id' => 2,
                'booking_number' => 'BK-0002',
                'room_id' => 2,
                'price' => 450,
                'price_per_date' => 450,
                'date_checkin' => '2023-10-5',
                'date_checkout' => '2023-10-6',
                'booking_date' => '2023-10-05',
                'days' => 1,
                'status_id' => 4,
                'booking_type' => 'Online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'card_id' => "1234",
                'payment_type' => "transfer",
                'slip' => '/images/bank/k-bankqr.png',
            ],
            [
                'id' => 3,
                'booking_number' => 'BK-0003',
                'room_id' => 2,
                'price' => 900,
                'price_per_date' => 450,
                'date_checkin' => '2023-10-6',
                'date_checkout' => '2023-10-8',
                'booking_date' => '2023-10-06,2023-10-07',
                'days' => 2,
                'status_id' => 4,
                'booking_type' => 'Online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'card_id' => "1234",
                'payment_type' => "transfer",
                'slip' => '/images/bank/k-bankqr.png',
            ],
            [
                'id' => 4,
                'booking_number' => 'BK-0004',
                'room_id' => 1,
                'price' => 2000,
                'price_per_date' => 400,
                'date_checkin' => '2023-10-10',
                'date_checkout' => '2023-10-15',
                'booking_date' => '2023-10-10,2023-10-11,2023-10-12,2023-10-13,2023-10-14',
                'days' => 5,
                'status_id' => 4,
                'booking_type' => 'Online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'card_id' => "1234",
                'payment_type' => "transfer",
                'slip' => '/images/bank/k-bankqr.png',
            ],
            [
                'id' => 5,
                'booking_number' => 'BK-0005',
                'room_id' => 3,
                'price' => 500,
                'price_per_date' => 500,
                'date_checkin' => '2023-10-10',
                'date_checkout' => '2023-10-11',
                'booking_date' => '2023-10-10',
                'days' => 1,
                'status_id' => 5,
                'booking_type' => 'Online',
                'cus_fname' => "Nantachai",
                'cus_lname' => "Ruecha",
                'cus_phone' => "0900099000",
                'email' => "nantachai.ru@gmail.com",
                'card_id' => "1234",
                'payment_type' => "transfer",
                'slip' => '/images/bank/k-bankqr.png',
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
