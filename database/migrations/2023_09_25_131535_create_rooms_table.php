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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->text('description')->nullable();
            $table->integer('adult');
            $table->integer('children');
            $table->string('area');
            $table->string('feature_ids');
            $table->string('fac_ids');
            $table->boolean('display')->default(true);

            $table->timestamps();
        });

        DB::table('rooms')->insert([
            [
                'id' => 1,
                'name' => 'A1',
                'price' => 400,
                'description' => 'This is A1',
                'adult' => 2,
                'children' => 1,
                'area' => 22,
                'feature_ids' => '1, 3, 5, 7',
                'fac_ids' => '1, 3, 4, 5, 6, 7',
                'display' => true,
            ],
            [
                'id' => 2,
                'name' => 'A2',
                'price' => 450,
                'description' => 'This is A1',
                'adult' => 2,
                'children' => 1,
                'area' => 23,
                'feature_ids' => '1, 3, 5, 7',
                'fac_ids' => '1, 3, 4, 5, 6, 7',
                'display' => true,
            ],
            [
                'id' => 3,
                'name' => 'A3',
                'price' => 500,
                'description' => 'This is A1',
                'adult' => 2,
                'children' => 2,
                'area' => 25,
                'feature_ids' => '1, 3, 5, 7',
                'fac_ids' => '1, 3, 4, 5, 6, 7, 8, 9',
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
        Schema::dropIfExists('rooms');
    }
};
