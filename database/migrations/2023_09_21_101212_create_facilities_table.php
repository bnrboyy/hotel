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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->text('description')->nullable();
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        DB::table('facilities')->insert([
            [
             'id' => 1,
             'name' => 'Wifi',
             'icon' => '/images/facilities/wifi-svgrepo.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 2,
             'name' => 'โทรทัศน์',
             'icon' => '/images/facilities/television.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 3,
             'name' => 'แอร์',
             'icon' => '/images/facilities/5.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 4,
             'name' => 'พัดลม',
             'icon' => '/images/facilities/fan.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 5,
             'name' => 'ตู้เย็น',
             'icon' => '/images/facilities/freezer.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 6,
             'name' => 'อ่างอาบน้ำ',
             'icon' => '/images/facilities/bath-tub.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 7,
             'name' => 'ตู้เสิ้อผ้า',
             'icon' => '/images/facilities/wardrobe.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 8,
             'name' => 'โต๊ะเครื่องแป้ง',
             'icon' => '/images/facilities/dressing-table.svg',
             'description' => '',
             'display' => true,
            ],
            [
             'id' => 9,
             'name' => 'โต๊ะทำงาน',
             'icon' => '/images/facilities/desk-furniture.svg',
             'description' => '',
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
        Schema::dropIfExists('facilities');
    }
};
