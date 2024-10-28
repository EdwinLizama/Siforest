<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\AdminSolicitudController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\HistorialController;

/**
 * Rutas de autenticación (login, registro y logout)
 */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/**
 * Rutas protegidas por autenticación
 */
Route::middleware('auth')->group(function () {

    /**
     * Rutas del dashboard del administrador
     */
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

        /**
         * Gestión de usuarios (solo accesible para admin)
         */
        Route::prefix('usuarios')->group(function () {
            Route::get('/', [UsuariosController::class, 'index'])->name('admin.usuarios');
            Route::get('/create', [UsuariosController::class, 'create'])->name('admin.usuarios.create');
            Route::post('/', [UsuariosController::class, 'store'])->name('usuarios.store');
            Route::get('/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
            Route::put('/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
            Route::post('/{id}/cambiar-rol', [UsuariosController::class, 'cambiarRol'])->name('usuarios.cambiar-rol');
            Route::delete('/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
        });

        /**
         * Gestión de solicitudes (admin)
         */
        Route::prefix('solicitudes')->group(function () {
            Route::get('/', [AdminSolicitudController::class, 'index'])->name('admin.solicitudes');
            Route::get('/mapa', [AdminSolicitudController::class, 'mostrarMapaSolicitudes'])->name('admin.solicitudes.mapa');
            Route::delete('/eliminar/{id}', [AdminSolicitudController::class, 'destroy'])->name('admin.solicitudes.eliminar');
            Route::post('/aprobar/{id}', [AdminSolicitudController::class, 'aprobar'])->name('admin.solicitudes.aprobar');
            Route::post('/rechazar/{id}', [AdminSolicitudController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
            Route::get('/{id}', [AdminSolicitudController::class, 'showAdmin'])->name('admin.show');
        });

        /**
         * Gestión de documentos (admin)
         */
        Route::prefix('documentos')->group(function () {
            Route::get('/', [DocumentosController::class, 'index'])->name('admin.documentos');
            Route::post('/store', [DocumentosController::class, 'store'])->name('admin.documentos.store');
            Route::put('/{id}', [DocumentosController::class, 'update'])->name('admin.documentos.update');
            Route::delete('/{id}', [DocumentosController::class, 'destroyAdmin'])->name('admin.documentos.destroy');
            Route::get('/download/{id}', [DocumentosController::class, 'download'])->name('admin.documentos.download');
        });

        /**
         * Configuración del administrador
         */
        Route::get('/configuracion', [AdminController::class, 'showConfig'])->name('admin.config');
        Route::post('/perfil/actualizar', [AdminController::class, 'updateProfile'])->name('admin.perfil.update');
        Route::post('/contrasena/actualizar', [AdminController::class, 'updatePassword'])->name('admin.password.update');
        Route::post('/language/update', [AdminController::class, 'updateLanguage'])->name('admin.language.update');
    });

    /**
     * Rutas del dashboard del usuario normal
     */
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/perfil', [UserController::class, 'perfil'])->name('user.perfil');
        Route::post('/perfil', [UserController::class, 'actualizarPerfil'])->name('user.perfil.update');
        Route::get('/perfil/cambiar-contrasena', [UserController::class, 'cambiarContrasena'])->name('user.cambiar-contrasena');
        Route::post('/perfil/cambiar-contrasena', [UserController::class, 'actualizarContrasena'])->name('user.cambiar-contrasena.update');
    });

    /**
     * Gestión de documentos (usuario normal)
     */
    Route::prefix('documentos')->group(function () {
        Route::get('/', [DocumentosController::class, 'index'])->name('documentos.index');
        Route::get('/create', [DocumentosController::class, 'create'])->name('documentos.create');
        Route::post('/', [DocumentosController::class, 'store'])->name('user.documentos.store');
        Route::get('/{id}/edit', [DocumentosController::class, 'edit'])->name('documentos.edit');
        Route::put('/{id}', [DocumentosController::class, 'update'])->name('documentos.update');
        Route::delete('/{id}', [DocumentosController::class, 'destroy'])->name('documentos.destroy');
        Route::get('/{id}/download', [DocumentosController::class, 'download'])->name('documentos.download');
        Route::get('/show/{id}', [DocumentosController::class, 'show'])->name('documentos.show');
    });


    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    Route::get('/historial/{id}', [HistorialController::class, 'show'])->name('historial.show');
    /**
     * Gestión de solicitudes (usuario normal)
     */
    Route::prefix('solicitudes')->group(function () {
        Route::get('/', [SolicitudesController::class, 'Solicitudes'])->name('solicitudes');
        Route::post('/formulario', [FormularioController::class, 'store'])->name('formulario.store');
        Route::get('/formulario', [FormularioController::class, 'formulario'])->name('formulario.index');
        Route::get('/formulario/{solicitud}', [FormularioController::class, 'show'])->name('solicitud.show');
        Route::get('/solicitud/{solicitud}/pdf', [FormularioController::class, 'downloadPDF'])->name('solicitud.pdf');
        Route::get('/formulario/{solicitud}/edit', [FormularioController::class, 'edit'])->name('solicitud.edit');
        Route::put('/solicitud/{solicitud}', [FormularioController::class, 'update'])->name('solicitud.update');
        Route::delete('/solicitud/{solicitud}', [FormularioController::class, 'destroy'])->name('solicitud.destroy');
    });
});
