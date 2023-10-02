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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->string('image');
            $table->boolean('default')->default(0);
            $table->foreign('room_id')
                    ->references('id')
                    ->on('rooms')
                    ->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('galleries')->insert([
            [
                'id' => 1,
                'room_id' => 1,
                'image' => '/images/rooms/1.jpg',
                'default' => 1,
            ],
            [
                'id' => 2,
                'room_id' => 1,
                'image' => '/images/rooms/2.png',
                'default' => 0,

            ],
            [
                'id' => 3,
                'room_id' => 2,
                'image' => '/images/rooms/2.png',
                'default' => 1,

            ],
            [
                'id' => 4,
                'room_id' => 2,
                'image' => '/images/rooms/3.png',
                'default' => 0,

            ],
            [
                'id' => 5,
                'room_id' => 3,
                'image' => '/images/rooms/5.png',
                'default' => 1,

            ],
            [
                'id' => 6,
                'room_id' => 3,
                'image' => '/images/rooms/6.png',
                'default' => 0,

            ],
            [
                'id' => 7,
                'room_id' => 3,
                'image' => '/images/rooms/7.png',
                'default' => 0,

            ],
            [
                'id' => 8,
                'room_id' => 3,
                'image' => '/images/rooms/4.png',
                'default' => 0,

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
        Schema::dropIfExists('galleries');
    }
};
