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
            $table->char('type_2', 50)->nullable();
            $table->integer('total')->nullable();
            $table->integer('hp')->nullable();
            $table->integer('attack')->nullable();
            $table->integer('defense')->nullable();
            $table->integer('sp_atk')->nullable();
            $table->integer('sp_def')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('generation')->nullable();
            $table->boolean('legendary')->default(false);
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
