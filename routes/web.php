<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'api'], function() use ($router) {
    $router->get('pokemons', ['uses' => 'PokemonController@index']);

    $router->get('pokemons/{uuid}', ['uses' => 'PokemonController@show']);

    $router->post('pokemons/create', ['uses' => 'PokemonController@store']);

    $router->delete('pokemons/{uuid}/delete', ['uses' => 'PokemonController@destroy']);

    $router->put('pokemons/{uuid}/update', ['uses' => 'PokemonController@update']);
});


