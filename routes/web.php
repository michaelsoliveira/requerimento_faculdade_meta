<?php

// use App\Http\Controllers\AuthController;

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequerimentoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PermissionController;

//login
Route::get('/', [AuthController::class, 'index'])->name('login'); // Exibe a página de login
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process'); // Processa o login do usuário
Route::get('/logout', [AuthController::class, 'destroy'])->name('login.destroy'); // Realiza o logout do usuário
Route::get('/create-user-login', [AuthController::class, 'create'])->name('login.create-user'); // Exibe o formulário de cadastro de usuário
Route::post('/store-user-login', [AuthController::class, 'store'])->name('login.store-user'); // Processa o cadastro do usuário



// Cursos
Route::get('/index-course', [CourseController::class, 'index'])->name('courses.index');
Route::get('/show-course/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/create-course', [CourseController::class, 'create'])->name('courses.create');
Route::post('/store-course', [CourseController::class, 'store'])->name('courses.store');
Route::get('/edit-course/{course}', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/update-course/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

//atendentes
Route::get('/index-atendimento', [AtendimentoController::class, 'index'])->name('atendimentos.index');
Route::get('/show-atendimento/{atendimento}', [AtendimentoController::class, 'show'])->name('atendimentos.show');
Route::get('/create-atendimento', [AtendimentoController::class, 'create'])->name('atendimentos.create');
Route::post('/store-atendimento', [AtendimentoController::class, 'store'])->name('atendimentos.store');
Route::get('/edit-atendimento/{atendimento}', [AtendimentoController::class, 'edit'])->name('atendimentos.edit');
Route::put('/update-atendimento/{atendimento}', [AtendimentoController::class, 'update'])->name('atendimentos.update');
Route::delete('/destroy-atendimento/{atendimento}', [AtendimentoController::class, 'destroy'])->name('atendimentos.destroy');





// resetar senha
Route::get('/esqueci-senha', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/esqueci-senha', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Permissões
Route::get('/permissoes', [PermissionController::class, 'index'])->name('permissions.index');
Route::post('/permissoes', [PermissionController::class, 'store'])->name('permissions.store');
Route::delete('/permissoes/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

// routes/web.php
Route::get('/requerimentos', [RequerimentoController::class, 'index'])->name('requerimentos.index');
Route::get('/create-requerimento', [RequerimentoController::class, 'create'])->name('requerimentos.create');
Route::post('/store-requerimento', [RequerimentoController::class, 'store'])->name('requerimentos.store');
Route::get('/show-requerimento/{requerimento}', [RequerimentoController::class, 'show'])->name('requerimentos.show');
Route::get('/edit-requerimento/{requerimento}', [RequerimentoController::class, 'edit'])->name('requerimentos.edit');
Route::put('/update-requerimento/{requerimento}', [RequerimentoController::class, 'update'])->name('requerimentos.update');
Route::delete('/destroy-requerimento/{requerimento}', [RequerimentoController::class, 'destroy'])->name('requerimentos.destroy');


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
