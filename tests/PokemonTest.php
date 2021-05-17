<?php

use App\Models\Pokemon;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PokemonTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * create pokemon.
     *
     * @return void
     */
    public function createPokemon()
    {
        Pokemon::factory()->create();
    }

    /**
     * test if index endpoint works.
     *
     * @return void
     */
    public function testGetPokemons()
    {
        $this->json('get', '/api/pokemons');

        $this->assertResponseOk();
    }

    /**
     * test if create pokemon endopint works.
     *
     * @return void
     */
    public function testCreatePokemon()
    {
        $this->json(
            'post',
            '/api/pokemons/create',
            [
                'num' => 10,
                'name' => "wowox",
                'type_1' => 'Water'
            ]
        )->seeJson(
            [
                'num' => 10,
                'name' => "wowox",
                'type_1' => 'Water',
                "uuid" => md5('10' . 'wowox'),
            ]
        );

        $this->assertResponseOk();
    }

    /**
     * test if update pokemon endpoint works
     *
     * @return void
     */
    public function testUpdatePokemon()
    {
        $this->createPokemon();

        $this->json(
            'put',
            '/api/pokemons/' . md5('10' . 'wowox') . '/update',
            [
                'name' => "wowo",
            ]
        )->seeJson([
            "uuid" => md5('10' . 'wowox'),
            "num" => "10",
            "name" => "wowo",
            "type_1" => "Water",
            "type_2" => null,
            "total" => null,
            "hp" => null,
            "attack" => null,
            "defense" => null,
            "sp_atk" => null,
            "sp_def" => null,
            "speed" => null,
            "generation" => null,
            "legendary" => "0"
        ]);;

        $this->assertResponseOk();
    }

    /**
     * test if show pokemon endpoint works.
     *
     * @return void
     */
    public function testShowPokemon()
    {
        $this->createPokemon();

        $this->json(
            'get',
            '/api/pokemons/' . md5('10' . 'wowox'),
        )->seeJson([
            "uuid" => md5('10' . 'wowox'),
            "num" => "10",
            "name" => "wowox",
            "type_1" => "Water",
            "type_2" => null,
            "total" => null,
            "hp" => null,
            "attack" => null,
            "defense" => null,
            "sp_atk" => null,
            "sp_def" => null,
            "speed" => null,
            "generation" => null,
            "legendary" => "0"
        ]);

        $this->assertResponseOk();
    }

    /**
     * test if delete pokemon endpoint works.
     *
     * @return void
     */
    public function testDeletePokemon()
    {
        $this->createPokemon();

        $this->json(
            'delete',
            '/api/pokemons/' . md5('10' . 'wowox') . '/delete',
        );

        $this->assertResponseOk();
    }
}
