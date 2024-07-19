<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductorasController;
use App\Http\Controllers\ReproductorController;
use App\Http\Controllers\PlataformasController;


Route::get('/columna',function () {
    return view('columnas');
});
Route::get('/principal',function () {
    return view('templates.principal');
})->name('templates.principal');

Route::get('/alumnos',function () {
    return view('alumnos');
});
Route::get('/examen',function () {
    return view('examen');
});

Route::get('/dashboard',[ViewsController::class,'dashboard'])->name('dashboard');
Route::get('/inicio',[ViewsController::class,'inicioView']);
Route::get('/contacto',[ViewsController::class,'contactView']);
Route::get('/columna',[ViewsController::class,'columnasView']);
Route::get('/alumnos',[ViewsController::class, 'alumnosView']);
Route::get('/examen',[ViewsController::class, 'examenView']);

Route::get('/',[PeliculasController::class, "view"])->name('peliculas');
// Route::get('/get/peliculas',[PeliculasController::class, "index"]); 
Route::get('/get/peliculas', [PeliculasController::class, 'getPeliculas']);
Route::get('/get/pelicula/{id}',[PeliculasController::class, "show"]);
Route::post('/insert/pelicula',[PeliculasController::class, "store"]);
Route::put('/update/pelicula/{id}',[PeliculasController::class, "update"]);
Route::delete('/delete/pelicula/{id}',[PeliculasController::class, "destroy"]);

Route::get('/view/categorias',[CategoriasController::class, "view"])->name('categorias');
Route::get('/get/categorias',[CategoriasController::class, "index"]);
Route::get('/get/categoria/{id}',[CategoriasController::class, "show"]);
Route::post('/insert/categoria',[CategoriasController::class, "store"]);
Route::put('/update/categoria/{id}',[CategoriasController::class, "update"]);
Route::delete('/delete/categoria/{id}',[CategoriasController::class, "destroy"]);

Route::get('/view/productoras',[ProductorasController::class, "view"])->name('productoras');
Route::get('/get/productoras',[ProductorasController::class, "index"]);
Route::get('/get/productora/{id}',[ProductorasController::class, "show"]);
Route::post('/insert/productora',[ProductorasController::class, "store"]);
Route::put('/update/productora/{id}',[ProductorasController::class, "update"]);
Route::delete('/delete/productora/{id}',[ProductorasController::class, "destroy"]);

Route::get('/reproducir', [reproductorController::class, 'index'])->name('reproductor.index');
Route::get('/reproducir/aleatorio', [reproductorController::class, 'random'])->name('reproductor.random');
Route::get('/reproducir/siguiente/{id}', [reproductorController::class, 'next'])->name('reproductor.next');
Route::get('/reproducir/anterior/{id}', [reproductorController::class, 'previous'])->name('reproductor.previous');
Route::get('/reproductor/play/{id}', [reproductorController::class, 'play'])->name('reproductor.play');



