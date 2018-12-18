<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->family= 'menu.main';
        $menu->title = 'Admin';
        $menu->grant_name = 'MENU_ADMIN';
        $menu->active = true;
        $menu->position = 1;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.main';
        $menu->title = 'Menus';
        $menu->linkref = 'route';
        $menu->href = 'admin.menu';
        $menu->grant_name = 'MENU_ADMIN';
        $menu->active = true;
        $menu->parent = 1;
        $menu->position = 2;
        $menu->save();


        $menu = new Menu();
        $menu->family= 'menu.main';
        $menu->title = 'Grants';
        $menu->linkref = 'route';
        $menu->href = 'admin.grants';
        $menu->grant_name = 'MENU_ADMIN';
        $menu->active = true;
        $menu->parent = 1;
        $menu->position = 3;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.user';
        $menu->title = 'menu.options';
        $menu->grant_name = 'ALL';
        $menu->linkref = 'view';
        $menu->href = 'home.partials.topmenu.user_ico';
        $menu->active = true;
        $menu->position = 4;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.user';
        $menu->title = '#usermenu';
        $menu->grant_name = 'ALL';

        $menu->linkref = 'view';
        $menu->href = 'home.partials.topmenu.user_menu';
        $menu->active = true;
        $menu->position = 5;
        $menu->parent = 4;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.user';
        $menu->title = '-';
        $menu->grant_name = 'USER_CHECK';
        $menu->active = true;
        $menu->position = 6;
        $menu->parent = 4;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.user';
        $menu->title = 'menu.disconect';
        $menu->grant_name = 'USER_CHECK';
        $menu->linkref = 'route';
        $menu->href = 'logout';
        $menu->active = true;
        $menu->position = 7;
        $menu->parent = 4;
        $menu->save();




        $menu = new Menu();
        $menu->family= 'menu.primary.left';
        $menu->title = 'menu.filtersby';
        $menu->grant_name = 'ALL';
        $menu->active = true;
        $menu->position = 8;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.primary.left';
        $menu->title = '#submenu_inmuebles';
        $menu->grant_name = 'ALL';
        $menu->linkref = 'view';
        $menu->href = 'home.partials.filtrar';
        $menu->active = true;
        $menu->parent = 8;
        $menu->position = 9;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.primary.right';
        $menu->title = 'menu.registernow';
        $menu->grant_name = 'USER_GUEST';
        $menu->linkref = '';
        $menu->href = '?dialog=/home/register';
        $menu->active = true;
        $menu->position = 10;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.primary.right';
        $menu->title = 'menu.create';
        $menu->grant_name = 'USER_CHECK';
        $menu->linkref = 'route';
        $menu->href = 'crear.alquiler';
        $menu->active = true;
        $menu->position = 11;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.primary.right';
        $menu->title = 'menu.selfcreate';
        $menu->grant_name = 'USER_CHECK';
        $menu->linkref = 'view';
        $menu->href = 'home.partials.topmenu.mis_alq';
        $menu->active = true;
        $menu->position = 12;
        $menu->save();

        $menu = new Menu();
        $menu->family= 'menu.primary.right';
        $menu->title = 'menu.help';
        $menu->grant_name = 'ALL';
        $menu->linkref = 'route';
        $menu->href = 'help';
        $menu->active = false;
        $menu->position = 13;
        $menu->save();



    }
}
