<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Curso</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Tipo</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requerimentos as $requerimento)
        <tr>
            <th>{{ $requerimento->id }}</th>
            <td>{{ $requerimento->nome }}</td>
            <td>{{ $requerimento->email }}</td>
            <td>{{ $requerimento->curso }}</td>
            <td>{{ $requerimento->disciplina }}</td>
            <td>{{ $requerimento->tipo }}</td>
            <td>{{ $requerimento->status }}</td>
            <td class="text-center">
                <a href="{{ route('requerimentos.show', $requerimento->id) }}" class="btn btn-primary btn-sm">Visualizar</a>
                <a href="{{ route('requerimentos.edit', $requerimento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form method="POST" action="{{ route('requerimentos.destroy', $requerimento->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja apagar esse registro?')">Apagar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>