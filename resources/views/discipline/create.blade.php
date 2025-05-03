@extends('layouts.admin')

@section('content')

    <h2>Cadastrar Disciplina</h2>

    <a href="{{ route('discipline.index', ['course' => $course->id]) }}">
        <button type="button">Disciplinas</button>
    </a><br><br>

    <x-alert />    

    {{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis suscipit magnam amet. Consequatur animi odio vitae dolorum asperiores cum exercitationem quo nam quaerat fugiat non vero mollitia, iste culpa aut! --}}

    <form action="{{ route('discipline.store') }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name') }}" required><br><br>

        <label>Descrição</label>
        <textarea name="description" id="description" rows="4" cols="30">{{ old('description') }}</textarea><br><br>

        <button type="submit">Cadastrar</button>

    </form>
@endsection