<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $tipo = new Tipo();
        $tipo->nombre = 'Apartamentos';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Campos';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Casas';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Cocheras';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Habitaciones';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Llave de Negocio';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Locales';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Oficinas';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Quintas';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Terrenos';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->nombre = 'Otros Inmuebles';
        $tipo->save();
    }
}
