<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\AboutController;
use App\Models\Vehicle;
use App\Http\Controllers\ProfileController; // Para rutas de autenticación de Breeze
use App\Http\Controllers\AdminVehicleController; // Para el controlador de administración de vehículos

// -------------------------------------------------------------
// RUTAS PÚBLICAS DEL SITIO WEB
// -------------------------------------------------------------

// Ruta de inicio (/)
Route::get('/', function () {
    // Obtiene 4 vehículos disponibles aleatorios para mostrar como destacados en la página de inicio
    $featuredVehicles = Vehicle::where('status', 'available')->inRandomOrder()->limit(4)->get();
    return view('welcome', compact('featuredVehicles'));
});

// Rutas para el Inventario de Vehículos
Route::get('/inventario', [VehicleController::class, 'index'])->name('inventory.index');
Route::get('/inventario/{slug}', [VehicleController::class, 'show'])->name('inventory.show');

// Rutas para las Páginas Estáticas del Concesionario
Route::get('/servicios', [ServiceController::class, 'index'])->name('services.index');
Route::get('/financiamiento', [FinanceController::class, 'index'])->name('finance.index');
Route::get('/acerca-de', [AboutController::class, 'index'])->name('about.index');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'submitForm'])->name('contact.submit');


// -------------------------------------------------------------
// RUTAS DEL PANEL DE ADMINISTRACIÓN (PROTEGIDAS POR AUTENTICACIÓN)
// -------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    // Ruta para el Dashboard del Admin (una vez logueado)
    // Redirige al usuario autenticado a esta vista por defecto
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Vista principal del panel admin
    })->name('dashboard'); // El nombre de ruta 'dashboard' es el que usa Breeze por defecto

    // Rutas de recursos para la gestión de vehículos (CRUD)
    Route::resource('admin/vehicles', AdminVehicleController::class)
         ->except(['show'])
         ->names([
             'index' => 'admin.vehicles.index',
             'create' => 'admin.vehicles.create',
             'store' => 'admin.vehicles.store',
             'edit' => 'admin.vehicles.edit',
             'update' => 'admin.vehicles.update',
             'destroy' => 'admin.vehicles.destroy',
         ]);

    // Las rutas de perfil de usuario también necesitan ser cargadas aquí si no están ya en auth.php
    // SIN EMBARGO, Laravel Breeze las maneja en auth.php, así que no deberíamos duplicarlas aquí.
    // Si hay un problema, es que el require de auth.php no está funcionando o la caché.
});

// -------------------------------------------------------------
// RUTAS DE AUTENTICACIÓN DE LARAVEL BREEZE
// ESTA LÍNEA ES FUNDAMENTAL para cargar las rutas de login, registro, perfil, etc.
// -------------------------------------------------------------
require __DIR__.'/auth.php';