<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasfaUserContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wasfa_user_contents', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('wasfa_id')->unsigned();
            $table->foreign('wasfa_id')->references('id')->on('wasfas')->onDelete('cascade');
            $table->bigInteger('wasfa_contents_id')->unsigned();
            $table->foreign('wasfa_contents_id')->references('id')->on('wasfa_contents')->onDelete('cascade');
            $table->string('contity'); //كمية
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
        Schema::dropIfExists('wasfa_user_contents');
    }
}
