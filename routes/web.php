<?php

// use App\Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequerimentoController;


Route::get('/', [AuthController::class, 'index'])->name('login'); // Exibe a página de login
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process'); // Processa o login do usuário
Route::get('/logout', [AuthController::class, 'destroy'])->name('login.destroy'); // Realiza o logout do usuário
Route::get('/create-user-login', [AuthController::class, 'create'])->name('login.create-user'); // Exibe o formulário de cadastro de usuário
Route::post('/store-user-login', [AuthController::class, 'store'])->name('login.store-user'); // Processa o cadastro do usuário

// Rotas protegidas por autenticação
Route::group(['Middleware' => 'auth'], function(){
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index'); // Lista os usuários cadastrados
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show'); // Exibe os detalhes de um usuário específico
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create'); // Exibe o formulário para cadastrar um novo usuário
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store'); // Processa o cadastro de um novo usuário
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit'); // Exibe o formulário de edição de um usuário
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user-update'); // Processa a atualização dos dados do usuário
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy'); // Exclui um usuário do sistema
});

Route::middleware(['auth'])->group(function () {
    Route::resource('requerimentos', RequerimentoController::class);
});

// routes/web.php
Route::get('requerimentos/create', [RequerimentoController::class, 'create'])->name('requerimentos.create');










// Route::get('/', [AuthController::class, 'index'])->name('login');
// Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
// Route::get('/logout', [AuthController::class, 'destroy'])->name('login.destroy');

// Route::get('/create-user-login', [AuthController::class, 'create'])->name('login.create-user'); //(cadastrar)
// Route::post('/store-user-login', [AuthController::class, 'store'])->name('login.store-user');

// // paginas privadas e publicas


// Route::group(['Middleware' => 'auth'], function(){
//     Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
//     Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
//     Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
//     Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
//     Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
//     Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user-update');
//     Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');    
// });



// Route::middleware(['auth'])->group(function () {
//     Route::resource('requerimentos', RequerimentoController::class);
// });

// // routes/web.php
// Route::get('requerimentos/create', [RequerimentoController::class, 'create'])->name('requerimentos.create');
