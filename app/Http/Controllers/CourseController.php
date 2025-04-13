<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    //Listar Cursos
    public function index()
    {   //recuperar os registros do banco de dados
        $courses = Course::orderBy('id', 'DESC')->get();
        //$courses = Course::paginate(10);
        //$courses = Course::where('id', 1000)->get();
        // carregar a view
        return view('courses.index', ['courses' => $courses]); 
    }

    //visualizar um unico curso
    public function show(Request $request)
    {   
       $course = Course::where('id', $request->course)->first();

        
        // carregar a view
        return view('courses.show', ['course' => $course]);
    }

    //cadastrar um curso
    public function create()
    {   // carregar a view
        return view('courses.create');
    }

    //cadastrar um curso
    public function store(Request $request)
    {   // cadastrar no banco de dados 
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        //redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
    }

    //editar um curso
    public function edit(Course $course)
    {  
        
        // carregar a view
        return view('courses.edit' , ['course' => $course]);
    }

    //atualizar no banco de dados de curso
    public function update(Request $request, Course $course)
    {   
        //editar informações no banco de dados 
        $course->update([
            'name' => $request->name
        ]);
        // redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
    }   

    // deletar um curso
    public function destroy(Course $course)
    {   
        //deletar no banco de dados
        $course->delete();
        // redirecionar o usuario, enviar uma mensagem de sucesso
        return redirect()->route('courses.index')->with('success', 'Curso removido com sucesso!');
    }
}
