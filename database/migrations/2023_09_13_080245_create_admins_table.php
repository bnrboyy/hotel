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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('admins')->insert([
            [
             'id' => 1,
             'display_name' => 'Tester',
             'username' => 'admin@example.com',
             'password' => '$2y$10$NWqZXU3U7OgUO7XTl9UC0eqDeSRZMof2/xOQ2N.SUlIE6pD2uMd2y', /* ASDqwe123 */
             'email' => "admin@example.com",
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
        Schema::dropIfExists('admins');
    }
};
