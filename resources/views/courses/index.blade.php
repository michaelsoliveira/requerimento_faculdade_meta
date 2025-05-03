@extends('layouts.admin')

@section('content')
<h2>Listar os Cursos</h2>

<a href="{{ route('courses.create') }}">
    <button type="button">Cadastrar</button>
</a><br><br>

<x-alert/>


{{-- Imprimir os registros --}}
@forelse ($courses as $course)
ID: {{ $course->id }}<br>
Nome: {{ $course->name }}<br>
Descrição: {{ $course->description }}<br>
Cadastrado: {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
Editado {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}<br><br>


<a href="{{ route('discipline.index', ['course' => $course->id]) }}">
    <button type="button">Disciplinas</button>
</a><br><br>
<a href="{{ route('courses.show', ['course' => $course->id]) }}">
    <button type="button">Visualizar</button>
</a><br><br>

<a href="{{ route('courses.edit', ['course' => $course->id]) }}">
    <button type="button">Editar</button>
</a><br><br>

<form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
</form>

<hr>

@empty
<p style="color: #f00">Nenhum curso encontrado!</p>
@endforelse

{{-- Imprimir a paginação --}}
{{-- {{ $courses->links() }} --}}
@endsection