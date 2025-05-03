<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
     // Listar as aulas
     public function index(Course $course)
     {
 
         // Recuperar as aulas do banco de dados
         $disciplines = Discipline::with('course')
             ->where('course_id', $course->id)
            // ->orderBy('order_discipline')
             ->get();
 
         // Carregar a VIEW
         return view('discipline.index', ['course' => $course, 'disciplines' => $disciplines]);
     }
 
     // Carregar o formulário cadastrar nova aula
     public function create(Course $course)
     {
         // Carregar a VIEW
         return view('discipline.create', ['course' => $course]);
     }
 
     // Cadastrar no banco de dados a nova aula
     public function store(Request $request)
     {
         // Recuperar a última ordem da aula no curso
         $lastOrderdiscipline = Discipline::where('course_id', $request->course_id)
           //  ->orderBy('order_discipline', 'DESC')
             ->first();
         // dd($lastOrderdiscipline);
 
         // Cadastrar no banco de dados na tabela aulas
         Discipline::create([
             'name' => $request->name,
             'description' => $request->description,
            // 'order_discipline' => $lastOrderdiscipline ? $lastOrderdiscipline->order_discipline + 1 : 1,
             'course_id' => $request->course_id
         ]);
 
         // Redirecionar o usuário, enviar a mensagem de sucesso
         return redirect()->route('discipline.index', ['course' => $request->course_id])->with('success', 'Disciplina cadastrada com sucesso!');
     }
}
