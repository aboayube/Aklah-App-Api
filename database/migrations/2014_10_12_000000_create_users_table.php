<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default('profile.png');
            $table->string('location')->default(0);
            $table->string('role');
            $table->string('mobile');
            $table->text('discription')->nullable();
            $table->text('discription_en')->nullable();
            $table->enum('gender', [0, 1])->default(1);
            $table->enum('status', [0, 1])->default(0);
            $table->string('price')->default(0);
            $table->double('longtoitle')->default(0);
            $table->double('attuite')->default(0);
            $table->string('address')->default('gaza');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
