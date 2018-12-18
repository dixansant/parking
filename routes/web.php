<?php


/** IDIOMA DE LA APP */
$langs=['es'];
$url= url()->current();
$pt=explode(".",$url);
$pt=explode("//",$pt[0]);
$lang=$pt[1];
$lang=in_array($lang,$langs)?$lang:'';
if ($lang!='') App::setLocale($lang);

Route::get('/', function () {

    return view('home',[

    ]);
});

// A esta ruta se redirige cuando sucede login [#REF: 000001]
Route::get('home', 'CommonController@homeAction')->name('home')->middleware('ajax');


Route::post('login', 'Auth\LoginController@loginPost')->name('login'); // enviar login
Route::get('home/logout', 'Auth\LoginController@logout')->name('logout'); // desconectarse
Route::get('home/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot'); // cargar para recuperar el password [#REF: 000002]
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('forgot.email');

Route::get('home/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset')->middleware('ajax');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Registration Routes...
Route::get('home/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('home/register', 'Auth\RegisterController@register');

// Admin
// Menu
Route::get('home/owner/menu.builder', 'OwnerController@showMenuAction')->name('admin.menu');
Route::post('admin/newmenu', 'OwnerController@newMenuAction')->name('admin.newmenu');
Route::post('admin/savemenu', 'OwnerController@saveMenuAction')->name('admin.save');
Route::post('admin/movemenu', 'OwnerController@moveMenuAction')->name('admin.movemenu');
Route::post('admin/removemenu', 'OwnerController@removeMenuAction')->name('admin.removemenu');

/*Sistema*/


Route::get('filtrar/{tipo}', 'CommonController@filtroAction')->name('filtrar.alquiler');
Route::get('home/crear/alquiler', 'CommonController@crearAction')->name('crear.alquiler');
Route::post('crear/alquiler', 'CommonController@salvarAction')->name('alquiler.enviar');
Route::post('crear/media', 'CommonController@mediaAction')->name('crear.media');


/* Filtros */
Route::get('home/filtrar/alquiler', 'CommonController@filtroAlquilerAction')->name('filtrar.alquiler');
Route::get('home/filtrar/venta', 'CommonController@filtroVentaAction')->name('filtrar.venta');
Route::get('home/tipo/{tipo}', 'CommonController@filtroAction')->name('filtrar.tipo');


/* */
Route::get('temp_medias/{filename}', 'CommonController@tempMediaAction')->name('imagen.temporal');
Route::get('home/mis/alquileres', 'CommonController@misAlquieresAction')->name('mis.alquileres');
Route::get('home/editar/{alquiler}', 'CommonController@editarAction')->name('aditar.alquiler');
Route::get('detalles/{alquiler}', 'CommonController@detallesAction')->name('ver.detalles');