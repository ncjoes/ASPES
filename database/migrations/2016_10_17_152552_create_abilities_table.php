<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100);
            $table->string('description');
            $table->timestamps();

            $table->unique('key', 'key');
        });

        DB::table('abilities')->insert([
                array(
                    'key' => '*',
                    'description' => 'All abilities',
                    'created_at' => '2016-08-18 13:02:00',
                    'updated_at' => '2016-08-18 13:02:00'
                )
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abilities');
    }
}
