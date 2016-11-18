<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exercise_id');
            $table->unsignedInteger('sender_id')->nullable();
            $table->unsignedInteger('recipient_id')->nullable();
            $table->string('recipient_email')->nullable();
            $table->unsignedTinyInteger('role');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('sender_id', 'i_sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recipient_id', 'i_recipient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('invitations');
    }
}
