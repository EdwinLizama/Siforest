<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DocumentosController; // Ensure this line is present and correct
use App\Http\Controllers\UserController; // Ensure this line is present and correct
use App\Http\Controllers\AdminController; // Ensure this line is present and correct
use App\Http\Controllers\formularioController; // Ensure this line is present and correct
use App\Http\Controllers\AdminSolicitudController; // Ensure this line is present and correct
use App\Http\Controllers\SolicitudesController; // Ensure this line is present and correct


/**
 * Rutas del dashboard (protegidas por autenticación)
 */
Route::middleware('auth')->group(function () {

    // Ruta para el dashboard del administrador
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // Rutas para gestión de usuarios (solo accesibles para admin)
    Route::get('/admin/usuarios', [UsuariosController::class, 'index'])->name('admin.usuarios'); // Ver todos los usuarios
    Route::get('/admin/usuarios/create', [UsuariosController::class, 'create'])->name('admin.usuarios.create'); // Mostrar formulario para crear un nuevo usuario
    Route::post('/admin/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store'); // Almacenar nuevo usuario
    Route::get('/admin/usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit'); // Mostrar formulario de edición
    Route::put('/admin/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update'); // Actualizar usuario
    Route::post('/admin/usuarios/{id}/cambiar-rol', [UsuariosController::class, 'cambiarRol'])->name('usuarios.cambiar-rol'); // Cambiar rol de usuario
    Route::delete('/admin/usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy'); // Eliminar usuario
 



    // Ruta para ver la lista de solicitudes en revisión
    Route::get('/admin/solicitudes', [AdminSolicitudController::class, 'index'])->name('admin.solicitudes');
    Route::get('/admin/solicitudes/mapa', [AdminSolicitudController::class, 'mostrarMapaSolicitudes'])->name('admin.solicitudes.mapa');
    Route::delete('/admin/solicitudes/eliminar/{id}', [AdminSolicitudController::class, 'destroy'])->name('admin.solicitudes.eliminar');

    // Ruta para aprobar una solicitud
    Route::post('/admin/solicitudes/aprobar/{id}', [AdminSolicitudController::class, 'aprobar'])->name('admin.solicitudes.aprobar');

    // Ruta para rechazar una solicitud (con motivo)
    Route::post('/admin/solicitudes/rechazar/{id}', [AdminSolicitudController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
    Route::get('admin/solicitudes/{id}', [AdminSolicitudController::class, 'showAdmin'])->name('admin.show');
   

    // Ruta para la vista de configuración del administrador
    Route::get('/admin/configuracion', [AdminController::class, 'showConfig'])->name('admin.config');

    // Ruta para actualizar el perfil del administrador
    Route::post('/admin/perfil/actualizar', [AdminController::class, 'updateProfile'])->name('admin.perfil.update');

    // Ruta para actualizar la contraseña del administrador
    Route::post('/admin/contrasena/actualizar', [AdminController::class, 'updatePassword'])->name('admin.password.update');

    // Ruta para cambiar el idioma
    Route::post('/admin/language/update', [AdminController::class, 'updateLanguage'])->name('admin.language.update');


    // Rutas de gestión de documentos para administradores
    Route::get('/admin/documentos', [DocumentosController::class, 'index'])->name('admin.documentos');
    Route::post('admin/documentos/store', [DocumentosController::class, 'store'])->name('admin.documentos.store');
    Route::put('admin/documentos/{id}', [DocumentosController::class, 'update'])->name('admin.documentos.update');
    Route::delete('admin/documentos/{id}', [DocumentosController::class, 'destroyAdmin'])->name('admin.documentos.destroy');
    Route::get('/admin/documentos/download/{id}', [DocumentosController::class, 'download'])->name('admin.documentos.download');

    // Rutas de gestión de documentos para usuarios normales
    Route::get('/documentos', [DocumentosController::class, 'index'])->name('documentos.index'); // Listar documentos
    Route::get('/documentos/create', [DocumentosController::class, 'create'])->name('documentos.create'); // Mostrar formulario para subir un nuevo documento
    Route::post('/documentos', [DocumentosController::class, 'store'])->name('user.documentos.store'); // Almacenar nuevo documento
    Route::get('/documentos/{id}/edit', [DocumentosController::class, 'edit'])->name('documentos.edit');
    Route::put('/documentos/{id}', [DocumentosController::class, 'update'])->name('documentos.update');
    Route::delete('/documentos/{id}', [DocumentosController::class, 'destroy'])->name('documentos.destroy');
    Route::get('/documentos/{id}/download', [DocumentosController::class, 'download'])->name('documentos.download');
    Route::get('/documentos/show/{id}', [DocumentosController::class, 'show'])->name('documentos.show');


    // Ruta para el dashboard del usuario
    Route::get('/user/dashboardUser', [HomeController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/perfil', [UserController::class, 'perfil'])->name('user.perfil');
    Route::post('/perfil', [UserController::class, 'actualizarPerfil'])->name('user.perfil.update');

    // Rutas de solicitudes
    Route::get('/solicitudes', [SolicitudesController::class, 'Solicitudes'])->name('solicitudes');
    Route::post('/formulario', [formularioController::class, 'store'])->name('formulario.store');
    Route::get('/formulario', [formularioController::class, 'formulario'])->name('formulario.index');
    Route::get('/formulario/{solicitud}', [formularioController::class, 'show'])->name('solicitud.show');
    Route::get('/solicitud/{solicitud}/pdf', [formularioController::class, 'downloadPDF'])->name('solicitud.pdf');
    Route::get('/formulario/{solicitud}/edit', [formularioController::class, 'edit'])->name('solicitud.edit');
    Route::put('/solicitud/{solicitud}', [formularioController::class, 'update'])->name('solicitud.update');
    Route::delete('/solicitud/{solicitud}', [formularioController::class, 'destroy'])->name('solicitud.destroy');
  

    Route::get('/perfil/cambiar-contrasena', [UserController::class, 'cambiarContrasena'])->name('user.cambiar-contrasena');
    Route::post('/perfil/cambiar-contrasena', [UserController::class, 'actualizarContrasena'])->name('user.cambiar-contrasena.update');





    // Ruta para cerrar sesión
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


/**
 * Rutas de autenticación (no protegidas)
 */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


/**
 * Rutas de registro (no protegidas)
 */
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
