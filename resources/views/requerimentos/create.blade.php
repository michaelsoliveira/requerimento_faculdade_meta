<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- resources/views/requerimentos/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <h2>Criar Novo Requerimento</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('requerimentos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="disciplina" class="form-label">Disciplina</label>
                    <input type="text" class="form-control" name="disciplina" required>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" name="tipo" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
    </div>
@endsection


</body>
</html>