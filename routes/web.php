<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CertificadosController;
use App\Http\Controllers\CertificateVariableController;
use App\Http\Controllers\CertificateSendController;
use App\Http\Controllers\CertificateBatchController;
use App\Http\Controllers\CertificateDownloadController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EntityFieldController;
use App\Http\Controllers\ContextController;
use App\Http\Controllers\ExcelImportController;
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

    // === SISTEMA DE BASE DE DATOS DINÁMICA ===
    
    // Gestión de Campos Dinámicos
    Route::prefix('entity-fields')->name('entity-fields.')->group(function () {
        Route::get('/', [EntityFieldController::class, 'index'])->name('index');
        Route::post('/', [EntityFieldController::class, 'store'])->name('store');
        Route::put('/{field}', [EntityFieldController::class, 'update'])->name('update');
        Route::delete('/{field}', [EntityFieldController::class, 'destroy'])->name('destroy');
        Route::get('/all', [EntityFieldController::class, 'getAllFields'])->name('all');
    });

    // Gestión de Entidades
    Route::prefix('entities')->name('entities.')->group(function () {
        Route::get('/', [EntityController::class, 'index'])->name('index');
        Route::post('/', [EntityController::class, 'store'])->name('store');
        Route::get('/export', [EntityController::class, 'export'])->name('export');
        Route::get('/{entity}', [EntityController::class, 'show'])->name('show');
        Route::put('/{entity}', [EntityController::class, 'update'])->name('update');
        Route::delete('/{entity}', [EntityController::class, 'destroy'])->name('destroy');
    });

    // Gestión de Contextos
    Route::prefix('contexts')->name('contexts.')->group(function () {
        Route::get('/', [ContextController::class, 'index'])->name('index');
        Route::post('/', [ContextController::class, 'store'])->name('store');
        Route::put('/{context}', [ContextController::class, 'update'])->name('update');
        Route::delete('/{context}', [ContextController::class, 'destroy'])->name('destroy');
        Route::get('/{context}/entities', [ContextController::class, 'showEntities'])->name('entities');
        Route::post('/{context}/attach', [ContextController::class, 'attachEntities'])->name('attach');
        Route::delete('/{context}/detach/{entity}', [ContextController::class, 'detachEntity'])->name('detach');
    });

    // Importación de Excel
    Route::prefix('excel-import')->name('excel-import.')->group(function () {
        Route::get('/', [ExcelImportController::class, 'index'])->name('index');
        Route::post('/upload', [ExcelImportController::class, 'upload'])->name('upload');
        Route::post('/create-fields', [ExcelImportController::class, 'createFields'])->name('create-fields');
        Route::post('/import', [ExcelImportController::class, 'import'])->name('import');
        Route::post('/cancel', [ExcelImportController::class, 'cancel'])->name('cancel');
    });
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
