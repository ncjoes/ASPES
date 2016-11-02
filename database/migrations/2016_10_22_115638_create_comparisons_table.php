<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComparisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparisons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('f1_id');
            $table->unsignedInteger('f2_id');
            $table->unsignedInteger('fcv__id');
            $table->unsignedInteger('evaluator_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('f1_id', 'c_f1_id')->references('id')->on('factors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('f2_id', 'c_f2_id')->references('id')->on('factors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fcv__id', 'c_fcv__id')->references('id')->on('fcvs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluator_id', 'c_evaluator_id')->references('id')->on('evaluators')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comparisons');
    }
}
