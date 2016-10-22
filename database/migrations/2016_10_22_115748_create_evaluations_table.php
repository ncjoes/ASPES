<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('factor_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('comment_id');
            $table->unsignedInteger('evaluator_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('factor_id', 'evt_factor_id')->references('id')->on('factors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subject_id', 'evt_subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comment_id', 'evt_comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluator_id', 'evt_evaluator_id')->references('id')->on('evaluators')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluations');
    }
}
