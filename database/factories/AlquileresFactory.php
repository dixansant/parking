<?php

use Faker\Generator as Faker;
use App\Tipo;
use App\Alquiler;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Alquiler::class, function (Faker $faker) {

    $clasif = ['Venta','Alquiler'][rand(0,1)];
    $tipo = Tipo::all()->random(1)->first()->nombre;
    $nombre= substr($tipo,0,strlen($tipo)-1)." ". $faker->name;
    return [
    'clasif' => $clasif,
    'usuario' => 1,
    'tipo' => $tipo,
    'nombre'=>  $nombre,
    'imagen'=> '',
    'descripcion'=> $faker->text(150),
    'barrio'=> $faker->address,
    'telefono'=> $faker->phoneNumber,
    'horarios'=> $faker->dateTime,

    ];
});
