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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('gmap');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->string('fb')->nullable();
            $table->string('line')->nullable();
            $table->string('ig')->nullable();
            $table->text('iframe')->nullable();

            $table->timestamps();
        });

        DB::table('contacts')->insert([
            [
             'id' => 1,
             'address' => '123/3 Sila Khonkaen 40000',
             'gmap' => 'https://maps.app.goo.gl/WvEWra4Ks47Wv2bu9',
             'phone1' => '0999999999',
             'phone2' => '0923333333',
             'email' => 'hotel@gmail.com',
             'fb' => 'facebook.com/hotelbooking',
             'line' => 'line.me',
             'iframe' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d244903.97722605334!2d102.820093!3d16.443879!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122602b91988e2f%3A0x93f0805cf799cc6!2z4LmA4LiX4Lio4Lia4Liy4Lil4LiZ4LiE4Lij4LiC4Lit4LiZ4LmB4LiB4LmI4LiZIOC4reC4s-C5gOC4oOC4reC5gOC4oeC4t-C4reC4h-C4guC4reC4meC5geC4geC5iOC4mSDguILguK3guJnguYHguIHguYjguJkgNDAwMDA!5e0!3m2!1sth!2sth!4v1695004235712!5m2!1sth!2sth',
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
        Schema::dropIfExists('contacts');
    }
};
