@extends('layouts.admin')

@section('content')
<br>
<h2>Lista de Disciplinas do Curso: {{ $course->name }}</h2>

<a href="{{ route('courses.index', ['course' => $course->id]) }}">
    <button type="button">Cursos</button>
</a><br><br>

<a href="{{ route('discipline.create', ['course' => $course->id]) }}">
    <button type="button">Cadastrar Disciplina</button>
</a><br><br>

<x-alert />

@forelse ($disciplines as $discipline)
        ID: {{ $discipline->id }}<br>
        Nome da disciplina: {{ $discipline->name }}<br>
        Descrição: {{ $discipline->description }}<br>
        Curso: {{ $discipline->course->name }}<br>
        Cadastrado: {{ \Carbon\Carbon::parse($discipline->created_at)->format('d/m/Y H:i:s') }}<br>
        Editado: {{ \Carbon\Carbon::parse($discipline->updated_at)->format('d/m/Y H:i:s') }}<br><br>

        <a href="{{ route('discipline.edit', ['discipline' => $discipline->id]) }}">
            <button type="button">Editar</button>
        </a>

        <a href="{{ route('discipline.show', ['discipline' => $discipline->id]) }}">
            <button type="button">Visualizar</button>
        </a><br><br>

        <form action="{{ route('discipline.destroy', ['discipline' => $discipline->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
        </form><br>


    @empty
        <p style="color: #f00">Nenhuma disciplina encontrada!</p>
    @endforelse

@endsection