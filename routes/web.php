<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


Route::get('/', function () {return view('auth.login');});



Route::middleware('auth')->group(function () 
{
    
    Route::get('/init', [HomeController::class, 'init'])->name('init');

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Agrupa por el middlware admin de spatie
    Route::group(['middleware' => ['role:Admin']], function () 
    {
        Route::get('/users/list', [UserController::class, 'index'])->name('users.index');
        Route::get('/users', [UserController::class, 'list'])->name('users.list');
        Route::post('/user', [UserController::class, 'create'])->name('users.create');
    });
    

});

require __DIR__.'/auth.php';
