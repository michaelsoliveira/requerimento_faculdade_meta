@extends('layouts.admin')

@section('content')
<h2>Editar a Disciplina do curso {{ $course->name }}</h2>

<a href="{{ route('discipline.index', ['course' => $discipline->course_id]) }}">
    <button type="button">Listar disciplinas</button>
</a><br><br>
 
<x-alert />


<form action="{{ route('discipline.update', ['discipline' => $discipline->id ]) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Curso: </label>
    <input type="text" name="name_course"  id="name_course" value="{{ $discipline->course->name }}" disabled><br><br>

    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name', $discipline->name) }}"><br><br>

    <label>Descrição: </label>
    <input type="text" name="description" id="description" placeholder="Descrição do curso" value="{{ old('description', $discipline->description) }}"><br><br>

    <button type="submit">Editar</button>

</form>
@endsection