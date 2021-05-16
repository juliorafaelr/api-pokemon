<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function(Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->integer('num');
            $table->char('name', 150);
            $table->char('type_1', 50);
            $table->char('type_2', 50);
            $table->integer('total');
            $table->integer('hp');
            $table->integer('attack');
            $table->integer('defense');
            $table->integer('sp_atk');
            $table->integer('sp_def');
            $table->integer('speed');
            $table->integer('generation');
            $table->boolean('legendary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemons');
    }
}
