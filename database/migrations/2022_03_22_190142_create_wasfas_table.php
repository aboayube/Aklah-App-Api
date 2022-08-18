<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasfasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wasfas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->longText('discription');
            $table->longText('discription_en');
            $table->enum('status', [0, 1])->default(0);
            $table->string('image');
            $table->string('price');
            $table->string('time_make');
            $table->string('number_user');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('wasfas');
    }
}
