<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CourseRegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

use App\Livewire\Counter;

use App\Livewire\CreateSale;
use App\Livewire\ListSales;

Route::get('/counter', Counter::class);

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
// Panneau disponible pour le super user
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');
});


// Ventes accessibles uniquement aux utilisateurs connectés
Route::middleware('auth')->group(function () {

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-user', [DashboardController::class, 'user'])->name('dashboard-user');//donne le role du user presentement connecter
    Route::get('/dashboard-super-admin', [DashboardController::class, 'super_admin'])->name('dashboard-super-admin');//met le user presentement connecter en superuser
    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('dashboard-admin');//met le user presentement connecter en admin

    //products
    //decortiquer le resource product pour que la creation de produit sois exclusivement autoriser au admin
    //cependant la liste de produit/service que l'on peux avoir pour une entreprise dois etre lier au business
    //et accessible au public
    Route::resource('products', ProductController::class)->except(['show']);

    //sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    //Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

    //businesses
    Route::get('/businesses/create', [BusinessController::class, 'create'])->name('businesses.create');//route businesses/create est disponible aussi si on a deja creer une entreprise, donc relation user has many businesses
    Route::post('/businesses', [BusinessController::class, 'store'])->name('businesses.store');
    Route::get('/businesses/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::put('/businesses/{id}', [BusinessController::class, 'update'])->name('businesses.update');

    //LIVEWIRE @sale
    Route::get('/sales/create-livewire', CreateSale::class)->name('sales.create.livewire');
    Route::get('/sales/live', ListSales::class)->name('sales.list');


});

// Admin uniquement : gestion des structures (boulangerie, centres culturels, etc.)
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

});

//LIEN ACCESSIBLE AU PUBLIC
//pour ce faire le admin user dois etre creer, le business dois etre creer, le cours dois etre creer et la on peux partager ce lien
Route::get('/products/{product}/registrations', [CourseRegistrationController::class, 'index'])
    ->name('products.registrations.index')
    ->middleware('auth');

Route::get('/product/{product}/registrations/create', [CourseRegistrationController::class, 'create'])->name('products.registrations.create');
Route::post('/product/{product}/registrations', [CourseRegistrationController::class, 'store'])->name('products.registrations.store');
//FIN LIEN ACCESSIBLE AU PUBLIC

//Login controller
Route::get('/login/create', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register controller
Route::get('/register/create', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', function () {
    return view('welcome');
});
