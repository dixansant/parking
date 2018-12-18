<?php

use Illuminate\Database\Seeder;
use App\Alquiler;

class AlquilerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Alquiler::class, 100)->create();
    }
}
