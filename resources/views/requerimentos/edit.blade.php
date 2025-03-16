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
<div class="container">
    <h1>Editar Status do Requerimento</h1>
    <form action="{{ route('requerimentos.update', $requerimento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="pendente" {{ $requerimento->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="aprovado" {{ $requerimento->status == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                <option value="negado" {{ $requerimento->status == 'negado' ? 'selected' : '' }}>Negado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection

</body>
</html>