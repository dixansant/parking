<?php

use Illuminate\Database\Seeder;
use App\Appvar;

class AppvarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appvar = new Appvar();
        $appvar->name = 'appname';
        $appvar->value = 'Alquileres Uruguay';
        $appvar->save();
    }
}
