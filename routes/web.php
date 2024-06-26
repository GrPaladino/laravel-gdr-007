<?php

use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\CharacterController;
use App\Http\Controllers\admin\TypeController;
use App\Http\Controllers\admin\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// #### Rotte pubbliche
// Route::get('/', function () {
//     return view('welcome');
// })->name("home");

Route::get('/welcome', [ItemController::class, 'welcome'])->name('welcome');


// #### Rotte private
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Rotte tabella Items
    Route::get('/', [ItemController::class, 'index'])->name('home');


});



// Rotte tabella Characters
Route::middleware('auth')->name('admin.')->prefix("admin")->group(function () {

    Route::resource('characters', CharacterController::class);
    Route::resource('types', TypeController::class);
});




require __DIR__ . '/auth.php';


