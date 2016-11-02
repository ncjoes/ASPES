<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('label');
            $table->boolean('system_defined')->default(0);
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        DB::table('roles')->insert([
                [
                    'name' => 'admin',
                    'label' => 'Administrator',
                    'system_defined' => 1
                ],
                [
                    'name' => 'academia',
                    'label' => 'Academia',
                    'system_defined' => 1
                ],
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
        Schema::drop('roles');
    }
}
