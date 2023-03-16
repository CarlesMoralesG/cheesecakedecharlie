<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\CestaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripePaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME
Route::get('/', function ()
{
    return view('pages.index');
});

// Nosotros
Route::get('/nosotros', function ()
{
    return view('pages.nosotros');
});

// Información general
Route::get('/informacion', function ()
{
    return view('pages.informacion');
});

// Cesta
Route::get('/cesta', function ()
{
    return view('pages.cesta');
});

//Legal

    // Politica de privacidad
    Route::get('/politicaPrivacidad', function (){ return view('layouts.politicaPrivacidad'); });

    // Proteccion de Datos
    Route::get('/proteccionDeDatos', function (){ return view('layouts.proteccionDeDatos'); });

    // Términos y Condiciones
    Route::get('/terminosYCondiciones', function (){ return view('layouts.terminosYCondiciones'); });


// Suscripcion a la Newsletter
Route::post('/newsletter', [NewsletterController::class, 'suscribeNewsletter'])->name('suscribeNewsletter');

// Register
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::get('/logout', [LogoutController::class, 'logout']);

// Home page
Route::get('/home', [HomeController::class, 'index']);

// Pedidos y reservas
Route::get('/pedidos', [PedidosController::class, 'articulos']);

// Edit user profile
Route::get('/profile', [ProfileController::class, 'show'])->name('showProfile');
Route::post('/profile', [ProfileController::class, 'editProfile'])->name('editProfile');

// Show pedidos usuario
Route::get('/pedidos/{IdUsuario}', [ProfileController::class, 'showPedidos'])->name('showPedidos');
Route::get('/detallePedido{IdPedido}', [ProfileController::class, 'showDetallePedidos'])->name('showDetallePedidos');

// Visualizar un Articulo
Route::get('/articulo/{IdArticulos}', [CompraController::class, 'showArticulo']);
Route::post('/articulo/{IdArticulos}', [CompraController::class, 'showArticulo']);

// CESTA
    Route::get('/cesta/{IdUsuario}', [CestaController::class, 'showCesta'])->name('showCesta');

    //Añadir producto a la cesta
    Route::post('/cesta', [CestaController::class, 'addCesta'])->name('addCesta');

    //Eliminar artículo de la cesta
    Route::get('/deleteCesta/{IdLineaPedido}', [CestaController::class, 'deleteCesta']);

    //Editar artículo cesta
    Route::get('/guardarCesta', [CestaController::class, 'guardarCesta'])->name('guardarCesta');

// COMPRA

    Route::get('/checkout/{IdUsuario}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout', [CheckoutController::class, 'view'])->name('checkout.view');

    // Actualizar base de datos con los datos de envío
    Route::post('/checkout/{IdUsuario}', [CheckoutController::class, 'success'])->name('checkout.success');


// ADMINISTRADOR

    //PEDIDOS

        // Show Pedidos
        Route::get('/adminPedidos', [AdminController::class, 'pedidos']);

        // Delete Pedidos
        Route::get('/deletePedido/{IdPedido}', [AdminController::class, 'deletePedido']);

        // Descargar pedidos por hacer
        Route::get("/descargarExcel", [AdminController::class, 'descargarExcel'])->name('descargarExcel');

        // LINEAS PEDIDOS

            // Show Pedidos
            Route::get('/adminLineasPedido/{IdPedido}', [AdminController::class, 'lineaspedido']);

            // Edit Pedido
            Route::post('/updatePedido', [AdminController::class, 'updatePedido'])->name('updatePedido');

    // TARTAS

        // Show Tartas
        Route::get('/adminTartas', [AdminController::class, 'tartas']);

        // Edit Tartas
        Route::get('/editTarta/{IdArticulos}', [AdminController::class, 'showeditTarta']);
        Route::post('/editTarta', [AdminController::class, 'editTarta'])->name('editTarta');

        // Add Tartas
        Route::get('/addTarta', [AdminController::class, 'showaddTarta']);
        Route::post('/addTarta', [AdminController::class, 'addTarta']);

        // Delete Tartas
        Route::get('/deleteTarta/{IdArticulos}', [AdminController::class, 'deleteTarta']);

        // Habilitar Tarta
        Route::get('/availableTarta/{IdArticulos}', [AdminController::class, 'availableTarta']);

    //DIY

        // Show DIY
        Route::get('/adminDIY', [AdminController::class, 'DIY']);

        // Edit DIY
        Route::get('/editDIY/{IdArticulos}', [AdminController::class, 'showeditDIY']);
        Route::post('/editDIY', [AdminController::class, 'editDIY'])->name('editDIY');

        // Add DIY
        Route::get('/addDIY', [AdminController::class, 'showaddDIY']);
        Route::post('/addDIY', [AdminController::class, 'addDIY']);

        // Delete DIY
        Route::get('/deleteDIY/{IdArticulos}', [AdminController::class, 'deleteDIY']);

        // Habilitar DIY
        Route::get('/availableDIY/{IdArticulos}', [AdminController::class, 'availableDIY']);

    // ROPA

        // Show Ropa
        Route::get('/adminRopa', [AdminController::class, 'Ropa']);

        // Edit Ropa
        Route::get('/editRopa/{IdArticulos}', [AdminController::class, 'showeditRopa']);
        Route::post('/editRopa', [AdminController::class, 'editRopa'])->name('editRopa');

        // Add Ropa
        Route::get('/addRopa', [AdminController::class, 'showaddRopa']);
        Route::post('/addRopa', [AdminController::class, 'addRopa']);

        // Delete Ropa
        Route::get('/deleteRopa/{IdArticulos}', [AdminController::class, 'deleteRopa']);

        // Habilitar Ropa
        Route::get('/availableRopa/{IdArticulos}', [AdminController::class, 'availableRopa']);

    // USUARIOS 

        // Show Usuarios
        Route::get('/adminUsuarios', [AdminController::class, 'usuarios']);

        // Edit Usuario
        Route::get('/editUsuario/{id}', [AdminController::class, 'showeditUsuario']);
        Route::post('/editUsuario', [AdminController::class, 'editUsuario'])->name('editUsuario');

        // Add Usuario
        Route::get('/addUsuario', [AdminController::class, 'showaddUsuario']);
        Route::post('/addUsuario', [AdminController::class, 'addUsuario']);

        // Delete Usuario
        Route::get('/deleteUsuario/{id}', [AdminController::class, 'deleteUsuario']);