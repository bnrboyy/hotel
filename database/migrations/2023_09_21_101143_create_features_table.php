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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        DB::table('features')->insert([
            [
             'id' => 1,
             'name' => 'เตียงเดี่ยว',
             'display' => true,
            ],
            [
             'id' => 2,
             'name' => 'เตียงคู่',
             'display' => true,
            ],
            [
             'id' => 3,
             'name' => 'ห้องน้ำในตัวห้อง',
             'display' => true,
            ],
            [
             'id' => 4,
             'name' => 'ห้องน้ำนอกตัวห้อง',
             'display' => true,
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
        Schema::dropIfExists('features');
    }
};
