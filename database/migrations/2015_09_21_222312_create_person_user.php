<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('PersonId');
            $table->integer('RoleId');
            $table->integer('ClientId');
            $table->index(['PersonId', 'user_id']);
            $table->foreign('user_id')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade');
        });

        Schema::create('person_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('person_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('PersonId')
                ->on('persons')
                ->onDelete('cascade');

            $table->index(['user_id', 'person_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('persons');
        Schema::drop('person_user');
    }
}
