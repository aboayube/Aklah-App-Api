<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->enum('status', [0, 1])->default(1);
            $table->text('discription');
            $table->text('discription_en');
            $table->string('image');
            $table->string('image_id');
            $table->string('email');
            $table->string('facebook');
            $table->string('twiter');
            $table->string('linked_in');
            $table->string('instagram');
            $table->string('whatsapp');
            $table->string('address');
            $table->string('address_en');
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
        Schema::dropIfExists('settings');
    }
}
