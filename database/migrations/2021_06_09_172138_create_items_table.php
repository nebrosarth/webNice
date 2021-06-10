<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            // ссылка на создателя и на объект основной модели
            $table->integer('user_id');
            $table->integer('character_id');
            // объявление внешних ключей
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('character_id')->references('id')->on('characters');
            $table->index('user_id');
            $table->index('character_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
