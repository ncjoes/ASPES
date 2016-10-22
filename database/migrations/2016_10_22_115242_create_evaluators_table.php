<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluators', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exercise_id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('type');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('exercise_id', 'evtr_exercise_id')->references('id')->on('exercises')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'evtr_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluators');
    }
}
