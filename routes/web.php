<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\cookController;
use App\Http\Controllers\UploadController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/home','home')->middleware('auth');
Route::view('/home','home');

Route::view('/admin','admin.home')->middleware('auth')->middleware('is_admin');

Route::get('/uploads/{id}',[UploadController::class,'storageUploadForm'])->middleware('auth')->middleware('is_admin')->name('uploads');
Route::post('/uploads/{id}',[UploadController::class,'storageUpload']);



Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);

Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');

Route::get('/register', [RegisterUserController::class,'showForm'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'store']);
Route::get('/create',[RegisterUserController::class,'createForm'])->middleware('auth')->middleware('is_admin');
Route::post('/create',[RegisterUserController::class,'createCookorAdmin']);
Route::post('/modifyAdmin',[UserController::class,'updatepasswordAdmin']);
Route::get('/modifyAdmin',[UserController::class,'updatepasswordAdminForm'])->middleware('auth')->middleware('is_admin')->name('modifyAdmin');
Route::get('/modifyCookpsd/{cook_id}',[UserController::class,'changecookpasswordForm'])->middleware('auth')->middleware('is_admin')->name('modifyCookpsd');
Route::post('/modifyCookpsd',[UserController::class,'changecookpassword']);
Route::get('/modifyCook/',[UserController::class,'listeCookForm'])->middleware('auth')->middleware('is_admin')->name('modifyCookpsd');

Route::get('/deleteSure/{id}',[UserController::class,'deleteAdminOrCookForm'])->middleware('auth')->middleware('is_admin')->name('deleteSure');
Route::post('/deleteSure/{id}',[UserController::class,'deleteAdminOrCook']);

Route::get('/deleteAdminOrCook',[UserController::class,'ListeDeleteForm'])->middleware('auth')->middleware('is_admin')->name('deleteAdminOrCook');




Route::get('/add',[PizzaController::class, 'addPizzaForm'])
    ->name('add');

Route::get('/liste',[PizzaController::class,'ListePizzaForm'])
    ->name('liste');

Route::post('/add',[PizzaController::class, 'addPizza']);

Route::get('/modify/{id}',[PizzaController::class,'PizzaModifyForm'])->name('modify');
Route::post('/modify/{id}',[PizzaController::class,'updatePizza']);
Route::post('/delete/{id}',[PizzaController::class,'deletePizza']);
Route::get('/delete/{id}',[PizzaController::class,'suppForm'])->name('delete');

Route::get('/', [PizzaController::class, 'index'])->name('index');

Route::get('/home', [UserController::class, 'index'])->name('home');

Route::get('/account',[UserController::class,'PasswordForm'])->name('account');
Route::post('/account',[UserController::class,'UpdatePassword']);
Route::get('/historical',[UserController::class,'CommandeUser'])->name('historical');
Route::get('/detailsUser/{id}',[UserController::class,'CommandeUserDetails'])->name('detailsUser');
Route::get('/untreated',[UserController::class,'CommandeUserUntreated'])->name('untreated');
Route::get('/commandes',[UserController::class,'CommandeAdminStatutDate'])->middleware('auth')->middleware('is_admin')->name('commandes');
Route::get('/commandeOndate',[UserController::class,'CommandeAdminOnDate'])->middleware('auth')->middleware('is_admin')->name('commandeOndate');
Route::get('/allcommandes',[UserController::class,'AllCommandesAdmin'])->middleware('auth')->middleware('is_admin')->name('allcommandes');
Route::get('/commande',[PizzaController::class,'PizzaListSimplePaginate'])->name('commande');

Route::post('/ajoutPanier/{pizza_id}', [CommandeController::class, 'ajouterAuPanier'])->name('ajoutPanier');
Route::get('/commande/{pizza_id}', [CommandeController::class, 'show'])->middleware('auth');
Route::post('/panier', [CommandeController::class, 'updateQuantite'])->name('modifier');
Route::get('/panier', [CommandeController::class, 'panierForm'])->middleware('auth');
Route::post('/panier/supprimer',[CommandeController::class, 'supprimerDuPanier'])->name('supprimer');
 Route::post('/panier/commande',[CommandeController::class,'commander'])->name('commande');

Route::get('/gestion', [cookController::class, 'index'])->name('index')->middleware('auth')->middleware('is_cook')->name('commande');
Route::get('/statut/{commande_id}', [cookController::class, 'statutForm'])->middleware('auth')->middleware('is_cook')->name('statut');
Route::post('/statut/{commande_id}', [cookController::class,'modifyStatut']);
Route::get('/details/{id}', [cookController::class, 'showdetails'])->middleware('auth')->middleware('is_cook')->name('details');
//Route::post('/details/{id}', [cookController::class, 'showdetails']);

Route::get('/accountCook',[cookController::class, 'PasswordCookForm'])->middleware('auth')->middleware('is_cook')->name('accountCook');
Route::post('/accountCook',[cookController::class, 'UpdatePasswordCook']);










