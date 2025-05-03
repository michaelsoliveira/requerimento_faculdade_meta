@extends('layouts.admin')

@section('content')
<br> <br>
<x-alert />
<h2>Detalhes do Curso {{ $course->name }}</h2>

<a href="{{ route('courses.index') }}">
    <button type="button">Listar</button>
</a><br><br>

<a href="{{ route('courses.edit', ['course' => $course->id]) }}">
    <button type="button">Editar</button>
</a><br><br>

<form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
</form><br>



ID: {{ $course->id }}<br>
Nome: {{ $course->name }}<br>
Descrição: {{ $course->description }}<br>
Cadastrado: {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
Editado: {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}<br>
<br>
<h2>disciplinas do curso </h2>
<div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome da Disciplina</th>
                <th scope="col">Descrição</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($disciplines as $discipline)

            <tr>
                <th> {{ $discipline->id }}</th>
                <td>{{ $discipline->name }}</td>
                <td>{{ $discipline->description }}</td>
                <td class="text-center">
                    <a href="{{ route('discipline.show', ['discipline' => $discipline->id]) }}" class="btn btn-primary btn-sm">Visualizar</a>
                
                </td>
            </tr>

            @empty
            <div class="alert alert-danger" role="alert">
                Nenhum disciplina encontrado
            </div>
            @endforelse
        </tbody>
    </table>
   
</div>
@endsection