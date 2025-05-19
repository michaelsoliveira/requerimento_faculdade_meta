<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplineRequest;
use App\Models\Course;
use App\Models\Discipline;
use Exception;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function getByCurso($cursoId)
{
    $disciplinas = Discipline::where('curso_id', $cursoId)->get(['id', 'nome']);
    return response()->json($disciplinas);
}

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

    public function show(Discipline $discipline)
    {

        return view('discipline.show', ['discipline' => $discipline]);
    }

    // Carregar o formulário cadastrar nova aula
    public function create(Course $course)
    {
        // Carregar a VIEW
        return view('discipline.create', ['course' => $course]);
    }

    // Cadastrar no banco de dados a nova aula
    public function store(DisciplineRequest $request)
    {
        //validar o formulario
        $request->validated();
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

    public function edit(Discipline $discipline)
    {
        $course = Course::findOrFail($discipline->course->id);
        //carregar a view
        return view('discipline.edit', ['discipline' => $discipline], ['course' => $course]);
    }

    public function update(DisciplineRequest $request, Discipline $discipline)
    {
        //validadar o formulário
        $request->validated();
        //editar informações no banco de dados 
        $discipline->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        // redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('discipline.index', ['course' => $discipline->course_id])->with('success', 'Disciplina editada com sucesso!');
    }

    public function destroy(Discipline $discipline)
    {

        try {
            //deletar no banco de dados
            $discipline->delete();
            // redirecionar o usuario, enviar uma mensagem de sucesso
            return redirect()->route('discipline.index', ['course' => $discipline->course_id])->with('success', 'Disciplina removida com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('discipline.index', ['course' => $discipline->course_id])->with('error', 'Erro ao remover a disciplina, verifique se ela possui aulas cadastradas!');
        }
    }
}
