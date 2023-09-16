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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->text('site_about');
            $table->boolean('shutdown')->default(false);
            $table->timestamps();
        });

        DB::table('settings')->insert([
            [
             'id' => 1,
             'site_title' => 'Hotel Booking',
             'site_about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt aspernatur enim magnam tenetur optio adipisci consequuntur non odio, explicabo laboriosam.',
             'shutdown' => 0,
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
        Schema::dropIfExists('settings');
    }
};
