# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We
believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain
out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction,
queueing, and caching.

# Api Pokemon Endpoints

### GET `https://pokemon.widutech.com/api/pokemons`

Parameters

param | type | description
--- | --- | ---
q | `string` | match if `name` or `type_1` or `type_2` contains `q`
page | `integer` | return selected page `(default 0)`
per_page | `integer` | number of rows to be returned `(default 100)`
num | `integer` | exact match on `num` field
name | `string` | exact match on `name` field
type_1 | `string` | exact match on `type_1` field
type_2 | `string` | exact match on `type_2` field
total | `integer` | exact match on `total` field
hp | `integer` | exact match on `hp` field
attack | `integer` | exact match on `attack` field
defense | `integer` | exact match on `defense` field
sp_atk | `integer` | exact match on `sp_atk` field
sp_def | `integer` | exact match on `sp_def` field
speed | `integer` | exact match on `speed` field
generation | `integer` | exact match on `generation` field
legendary | `boolean` | exact match on `legendary` field

### GET `https://pokemon.widutech.com/api/pokemons/<uuid>`

Parameters

param | type | description
--- | --- | ---  
uuid | `string` | pokemon uuid

### POST `https://pokemon.widutech.com/api/pokemons/create`

Parameters

param | type | description
--- | --- | ---
num | `integer (required)` |
name | `string (required)` |
type_1 | `string (require)`| **valid values** `Grass`,`Fire`,`Water`,`Bug`,`Normal`,`Poison`,`Electric`,`Ground`,`Fairy`,`Fighting`,`Psychic`,`Rock`,`Ghost`,`Ice`,`Dragon`,`Dark`,`Steel`,`Flying`
type_2 | `string` | **valid values** `Grass`,`Fire`,`Water`,`Bug`,`Normal`,`Poison`,`Electric`,`Ground`,`Fairy`,`Fighting`,`Psychic`,`Rock`,`Ghost`,`Ice`,`Dragon`,`Dark`,`Steel`,`Flying`
total | `integer` |
hp | `integer` |
attack | `integer` |
defense | `integer` |
sp_atk | `integer` |
sp_def | `integer` |
speed | `integer` |
generation | `integer` |
legendary | `boolean` | Default `false`

### PUT `https://pokemon.widutech.com/api/pokemons/<uuid>/update`

Parameters

param | type | description
--- | --- | ---
num | `integer` |
name | `string` |
type_1 | `string`| **valid values** `Grass`,`Fire`,`Water`,`Bug`,`Normal`,`Poison`,`Electric`,`Ground`,`Fairy`,`Fighting`,`Psychic`,`Rock`,`Ghost`,`Ice`,`Dragon`,`Dark`,`Steel`,`Flying`
type_2 | `string` | **valid values** `Grass`,`Fire`,`Water`,`Bug`,`Normal`,`Poison`,`Electric`,`Ground`,`Fairy`,`Fighting`,`Psychic`,`Rock`,`Ghost`,`Ice`,`Dragon`,`Dark`,`Steel`,`Flying`
total | `integer` |
hp | `integer` |
attack | `integer` |
defense | `integer` |
sp_atk | `integer` |
sp_def | `integer` |
speed | `integer` |
generation | `integer` |
legendary | `boolean` |

### DELETE `https://pokemon.widutech.com/api/pokemons/<uuid>/delete`

Parameters

param | type | description
--- | --- | ---  
uuid | `string` | pokemon uuid

## Deployment

- clone the repo and `cd api-pokemon`
- run `composer install`
- run `cp .env.example .env`
- create empty file `database.sqlite` on `./database`
- run `php artisan  migrate --seed`
- run `php -S localhost:8000 -t public` to start the local server

should work out of the box.

you could change some values on the .env like the environment .etc

## unit test

if you want to run the unit test run ` ./vendor/bin/phpunit` on the root of the project

unit test path `tests/PokemonTest.php`
