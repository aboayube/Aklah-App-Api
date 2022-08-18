<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasfaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wasfa_users', function (Blueprint $table) {
            $table->id();
            $table->string('note')->nullable();
            $table->string('note_en')->nullable();
            $table->string('countity');
            $table->string('price');
            $table->enum('status', ['card', 'pendeing',  'finish', 'cacncle', "end"]);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('chef_id')->unsigned();
            $table->foreign('chef_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('wasfa_id')->unsigned();
            $table->foreign('wasfa_id')->references('id')->on('wasfas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wasfa_users');
    }
}
