<?php

use Illuminate\Database\Seeder;
use App\Priv;

class PrivTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priv = new Priv();
        $priv->origen = 'ROLE_OWNER';
        $priv->destiny = 'MENU_ADMIN';
        $priv->save();

        $priv = new Priv();
        $priv->origen = 'ROLE_CLIENT,ROLE_ADMIN';
        $priv->destiny = 'MENU_OPTIONS';
        $priv->save();
    }
}
