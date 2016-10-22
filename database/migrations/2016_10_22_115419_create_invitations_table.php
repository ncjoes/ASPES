<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sender_id')->nullable();
            $table->unsignedInteger('exercise_id');
            $table->string('recipient_email');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('sender_id', 'i_sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('exercise_id', 'i_exercise_id')->references('id')->on('exercises')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invitation');
    }
}
