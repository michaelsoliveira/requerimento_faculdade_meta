<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequerimentoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PermissionController;

// ==============================
// ROTAS PÚBLICAS (sem auth)
// ==============================

// Login & Registro
Route::get('/', [AuthController::class, 'index'])->name('login'); // Página de login
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [AuthController::class, 'destroy'])->name('login.destroy');

Route::get('/create-user-login', [AuthController::class, 'create'])->name('login.create-user');
Route::post('/store-user-login', [AuthController::class, 'store'])->name('login.store-user');

// Esqueci minha senha
Route::get('/esqueci-senha', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/esqueci-senha', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');


// ==============================
// ROTAS PROTEGIDAS POR AUTENTICAÇÃO
// ==============================
Route::middleware(['auth'])->group(function () {

    // Usuários
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user-update');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Cursos
    Route::get('/index-course', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/show-course/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/create-course', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/store-course', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/edit-course/{course}', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/update-course/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Disciplinas
    Route::get('/index-discipline/{course}', [DisciplineController::class, 'index'])->name('discipline.index');
    Route::get('/show-discipline/{discipline}', [DisciplineController::class, 'show'])->name('discipline.show');
    Route::get('/create-discipline/{course}', [DisciplineController::class, 'create'])->name('discipline.create');
    Route::post('/store-discipline', [DisciplineController::class, 'store'])->name('discipline.store');
    Route::get('/edit-discipline/{discipline}', [DisciplineController::class, 'edit'])->name('discipline.edit');
    Route::put('/update-discipline/{discipline}', [DisciplineController::class, 'update'])->name('discipline.update');
    Route::delete('/destroy-discipline/{discipline}', [DisciplineController::class, 'destroy'])->name('discipline.destroy');
    Route::get('/disciplinas/{curso_id}', function ($curso_id) {
        return \App\Models\Discipline::where('course_id', $curso_id)->get(['id', 'nome']);
    });


    // Atendimentos
    Route::get('/index-atendimento', [AtendimentoController::class, 'index'])->name('atendimentos.index');
    Route::get('/show-atendimento/{atendimento}', [AtendimentoController::class, 'show'])->name('atendimentos.show');
    Route::get('/create-atendimento', [AtendimentoController::class, 'create'])->name('atendimentos.create');
    Route::post('/store-atendimento', [AtendimentoController::class, 'store'])->name('atendimentos.store');
    Route::get('/edit-atendimento/{atendimento}', [AtendimentoController::class, 'edit'])->name('atendimentos.edit');
    Route::put('/update-atendimento/{atendimento}', [AtendimentoController::class, 'update'])->name('atendimentos.update');
    Route::delete('/destroy-atendimento/{atendimento}', [AtendimentoController::class, 'destroy'])->name('atendimentos.destroy');

    // Requerimentos
    Route::get('/requerimentos', [RequerimentoController::class, 'index'])->name('requerimentos.index');
    Route::get('/create-requerimento', [RequerimentoController::class, 'create'])->name('requerimentos.create');
    Route::post('/store-requerimento', [RequerimentoController::class, 'store'])->name('requerimentos.store');
    Route::get('/show-requerimento/{requerimento}', [RequerimentoController::class, 'show'])->name('requerimentos.show');
    Route::get('/edit-requerimento/{requerimento}', [RequerimentoController::class, 'edit'])->name('requerimentos.edit');
    Route::put('/update-requerimento/{requerimento}', [RequerimentoController::class, 'update'])->name('requerimentos.update');
    Route::delete('/destroy-requerimento/{requerimento}', [RequerimentoController::class, 'destroy'])->name('requerimentos.destroy');
    Route::get('/requerimentos/download/{id}', [RequerimentoController::class, 'download'])->name('requerimentos.download');    
    Route::get('/disciplinas-por-curso/{id}', [App\Http\Controllers\RequerimentoController::class, 'getDisciplinasPorCurso']);

    // Permissões
    Route::get('/permissoes', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissoes', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissoes/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});
