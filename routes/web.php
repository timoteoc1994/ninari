<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\CertificateVariableController;
use App\Http\Controllers\CertificateSendController;
use App\Http\Controllers\CertificateBatchController;
use App\Http\Controllers\CertificateDownloadController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //ruta certificados

    Route::get('certificados', [CertificadosController::class, 'index'])->name('certificados.index');

    Route::post('certificados', [CertificadosController::class, 'store'])->name('certificados.store');
    Route::get('certificados/{id}/edit', [CertificadosController::class, 'edit'])->name('certificados.edit');
    Route::post('certificados/{certificado}', [CertificadosController::class, 'update'])
        ->name('certificados.update');

    Route::delete('certificados/{certificado}', [CertificadosController::class, 'destroy'])->name('certificados.destroy');

    // Variables
    Route::post('certificados/{certificado}/variables', [CertificateVariableController::class, 'store'])->name('certificados.variables.store');
    Route::get('certificados/{certificado}/variables', [CertificateVariableController::class, 'index'])->name('certificados.variables.index');

    // Certificate Sending
    Route::post('/certificados/{certificado}/send/single', [CertificateSendController::class, 'sendSingle'])->name('certificados.send.single');
    Route::post('/certificados/{certificado}/send/bulk', [CertificateSendController::class, 'sendBulk'])->name('certificados.send.bulk');

    // Certificate History
    Route::get('/certificados/{certificado}/batches', [CertificateBatchController::class, 'index'])->name('certificados.batches.index');
    Route::get('/batches/{batch}', [CertificateBatchController::class, 'show'])->name('certificados.batches.show');
    Route::get('/batches/{batch}/export', [CertificateBatchController::class, 'export'])->name('certificados.batches.export');
    Route::post('/recipients/{recipient}/resend', [CertificateBatchController::class, 'resend'])->name('certificados.recipients.resend');
});

// Public Download Route
Route::get('/certificate/download/{token}', [CertificateDownloadController::class, 'download'])->name('certificate.download');

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


//rutas pagina web 2
Route::get('/inicio2', function () {
    return Inertia::render('Web2/Inicio');
})->name('inicio2');
