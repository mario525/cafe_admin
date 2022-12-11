<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Utils\Notification;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas que requieren que el usuario este logeado
Route::group(['middleware' => 'auth'], function () {
    Route::post('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    // ==================== Estas rutas se deben remplazar con las rutas con el controller ====================
    Route::get('/products', function () {
        return view('products.index');
    })->name('products');
    Route::get('/pedidos-detalles', function () {
        return view('history.index');
    })->name('pedidos.detalles');
    Route::get('/usuarios-detalles', function () {
        return view('users.index');
    })->name('usuarios.detalles');
    Route::get('/categorias-detalles', function () {
        return view('categorias.index');
    })->name('categorias.detalles');
    Route::get('/insumos-detalles', function () {
        return view('insumos.index');
    })->name('insumos.detalles');
    Route::get('/subida-csv', function () {
        return view('users.masiva');
    })->name('subida.csv');
    //Obtencion de las  coordenadas cartesianas  de la ubicacion de los agentes.
    Route::get('/home/agentes', [App\Http\Controllers\HomeController::class, 'getCurrentPositionInspectors'])->name('position.inspectors');
    Route::get('/pedidos-activos', [App\Http\Controllers\OrderController::class, 'pedidosActivos'])->name('activos');
    Route::resource('pedidos', 'App\Http\Controllers\HistoryController');
    Route::post('/usuarios-masivos', [App\Http\Controllers\UserController::class, 'subirUsuarios'])->name('usuarios.masivos');
    Route::post('/button-selection/{id}', [App\Http\Controllers\OrderController::class, 'buttonselection'])->name('buttonsel');


    Route::resource('configs', 'App\Http\Controllers\ConfigController');
    Route::post('/update/site/settings', [App\Http\Controllers\ConfigController::class, 'updateSiteSettings'])->name('configs.update.site_settings');
    Route::resource('historial', 'App\Http\Controllers\UserController');
    Route::resource('product', 'App\Http\Controllers\ProductoController');
    Route::get('producto/getdata', [App\Http\Controllers\ProductoController::class, 'getdata'])->name('categorias.getdata');
    Route::resource('usuarios', 'App\Http\Controllers\UserController');
    Route::get('usuario/getdata', [App\Http\Controllers\UserController::class, 'getdata'])->name('roles.getdata');
    //JGRID FOR APIS
    Route::resource('categorias', 'App\Http\Controllers\CategoriaController');
    Route::post('categorias/filter', [App\Http\Controllers\CategoriaController::class, 'filter'])->name('categorias.filter');
    Route::resource('insumos', 'App\Http\Controllers\InsumoController');
    Route::post('insumos/filter', [App\Http\Controllers\InsumoController::class, 'filter'])->name('insumos.filter');


});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::resource('dashboards', 'App\Http\Controllers\DashboardController');


