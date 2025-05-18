@extends('layouts.admin')

@section('content')

<h2>Cadastrar Disciplina do curso {{ $course->name }}</h2>

<a href="{{ route('discipline.index', ['course' => $course->id]) }}">
    <button type="button">Disciplinas</button>
</a><br><br>

<x-alert />

<form action="{{ route('discipline.store') }}" method="POST">
    @csrf
    @method('POST')

    <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name') }}"><br><br>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" name="description" id="description" rows="3" value="{{ old('description') }}"></textarea>
    </div>

    <button type="submit">Cadastrar</button>

</form>
@endsection