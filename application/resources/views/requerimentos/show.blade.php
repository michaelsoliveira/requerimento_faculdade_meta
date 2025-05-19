@extends('layouts.admin')
@section('content')

<div class="card mt-4 mb-4 border-light shadow">

    <div class="card-header hstack gap-2">
        <span>Visualizar requerimento</span>
        <span class="ms-auto d-sm-flex flex-row">
            <a href="{{ route('requerimentos.index')}}" class="btn btn-info btn-sm me-1">lista de requeriemnto</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert />
        <dl class="row">
            <dt class="col-sm-3">Protocolo:</dt>
            <dd class="col-sm-9">{{ $requerimentos->protocolo }} </dd>

            <dt class="col-sm-3">Aluno:</dt>
            <dd class="col-sm-9">{{ $requerimentos->user->name }} </dd>

            <dt class="col-sm-3">Matricula:</dt>
            <dd class="col-sm-9">{{ $requerimentos->matricula }} </dd>

            <dt class="col-sm-3">Curso:</dt>
            <dd class="col-sm-9">{{ $requerimentos->course->name }}</dd>

            <dt class="col-sm-3">Tipo de Requerimento:</dt>
            <dd class="col-sm-9">{{ $requerimentos->tipo_requerimento }}</dd>

            <dt class="col-sm-3">Disciplinas:</dt>
<dd class="col-sm-9">
    @forelse ($requerimentos->disciplines as $disciplina)
        {{ $disciplina->name }}<br>
    @empty
        Nenhuma disciplina vinculada.
    @endforelse
</dd>



            <dt class="col-sm-3">Descrição:</dt>
            <dd class="col-sm-9">{{ $requerimentos->descricao }}</dd>

            <dt class="col-sm-3">Status:</dt> <br> <br>
            <dd class="col-sm-9">{{ $requerimentos->status }}</dd>
            <br>
            <dt class="col-sm-3">Solicitado:</dt>
            <dd class="col-sm-9">{{ \carbon\carbon::parse ($requerimentos->created_at)->format ('d/m/y h:i:s')}}.</dd>

            <dt class="col-sm-3">Editado</dt>
            <dd class="col-sm-9">{{ \carbon\carbon::parse ($requerimentos->updated_at)->format ('d/m/y h:i:s')}}.</dd>
        </dl>
    </div>

    @endsection