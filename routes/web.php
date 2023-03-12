<?php

use App\Http\Controllers\ContratController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    /* Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');*/
   Route::resource('roles', RoleController::class);
   Route::resource('users', UserController::class);
   Route::resource('demandes', DemandeController::class);
   Route::get('demandes/calc_duration/{dt_start}/{dt_fin}/{start_type}/{fin_type}', [DemandeController::class,"calc_duration"]);


    Route::prefix('hr')->group(function () {
        Route::get("demandes/create/{id}",[DemandeController::class,"create"])->name("hr.demandes.create");
       // Route::get("demandes/create",[DemandeController::class,"create"])->name("hr.demandes.create");
        Route::get("demandes/list",[DemandeController::class,"hrListDemande"])->name("hr.demandes.list");
        Route::get("demandes/employer/{id}",[DemandeController::class,"index"])->name("hr.demandes.employer");
        Route::get("demandes/rejete/{id}",[DemandeController::class,"rejete"])->name("hr.demandes.rejete");
        Route::get("demandes/validat/{id}",[DemandeController::class,"validat"])->name("hr.demandes.validat");
        Route::get("employers/",[UserController::class,"getEmployes"])->name("hr.employer.index");
       // Route::resource("contrats/",ContratController::class,["names" => "hr.contrats"]);
        Route::resource("positions/",PositionController::class,["names" => "hr.positions"]);
        Route::resource("projets/",ProjetController::class,["names" => "hr.projets"]);

       //// Route::resource("types/",TypeController::class,["names" => "hr.types"]);
        Route::get("types/activate/{id}",[TypeController::class,"activate"])->name("hr.types.activate");
        Route::get("types/deactivate/{id}",[TypeController::class,"deactivate"])->name("hr.types.deactivate");

    });

});
?>