@extends('layouts.admin')

@section('content')
<h2>Editar o Curso</h2>

<a href="{{ route('courses.index') }}">
    <button type="button">Listar Curso</button>
</a><br><br>

<a href="{{ route('courses.show', ['course' => $course->id]) }}">
    <button type="button">Visualizar</button>
</a><br><br>

<x-alert/>
<form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name', $course->name) }}"><br><br>

    <label>Descrição: </label>
    <input type="text" name="description" id="description" placeholder="Descrição do curso" value="{{ old('description', $course->description) }}"><br><br>

    <button type="submit">Salvar</button>

</form>
@endsection