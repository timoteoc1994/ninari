<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// Redirigir login y register a la página principal
Route::get('/login', function () {
    return redirect('/');
})->name('login');
Route::post('/login', function () {
    return redirect('/');
});

Route::get('/register', function () {
    return redirect('/');
})->name('register');
Route::post('/register', function () {
    return redirect('/');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/nosotros', function () {
    return Inertia::render('Nosotros');
})->name('nosotros'); // <--- Nombre de la ruta correcto
Route::get('/ecosistema-ninari', function () {
    return Inertia::render('Ecosistema');
})->name('ecosistema'); // <--- Nombre de la ruta correcto
Route::get('/programas', function () {
    return Inertia::render('Programas');
})->name('programas'); // <--- Nombre de la ruta correcto
Route::get('/contacto', function () {
    return Inertia::render('Contacto');
})->name('contacto'); // <--- Nombre de la ruta correcto


Route::post('contacto_guardar', [ContactoController::class, 'contacto_guardar'])->name('contacto_guardar');
