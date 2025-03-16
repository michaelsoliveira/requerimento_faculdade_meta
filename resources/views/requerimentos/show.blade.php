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
    <h1>Detalhes do Requerimento</h1>
    <p><strong>Disciplina:</strong> {{ $requerimento->disciplina }}</p>
    <p><strong>Tipo:</strong> {{ $requerimento->tipo }}</p>
    <p><strong>Descrição:</strong> {{ $requerimento->descricao }}</p>
    <p><strong>Status:</strong> {{ $requerimento->status }}</p>
    <a href="{{ route('requerimentos.index') }}" class="btn btn-primary">Voltar</a>
</div>
@endsection

</body>
</html>