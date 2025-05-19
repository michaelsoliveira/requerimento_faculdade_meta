@extends('layouts.admin')

@section('content')
<br>
<div class="card-header hstack gap-2">
    <h2>Bem vindo ao sistema {{ Auth::user()->name }}</h2>
    <span class="ms-auto">
        <a href="{{ route('requerimentos.create')}}" class="btn btn-success btn-sm">Solicitar Requerimento</a>
        <a href="{{ route('requerimentos.index') }}" class="btn btn-info btn-sm">Lista de Requerimentos</a>
        <a href="{{ route('courses.index') }}" class="btn btn-info btn-sm">Cursos</a>
    </span>
</div>


<x-alert />

<div class="card mt-4 mb-4">
    <div class="card-header">
        <h2>Historico de requerimentos enviados</h2>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Protocolo</th>
                    <th scope="col">Tipo de Requerimento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de Envio</th>
                    <th scope="col">Anexo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requerimentos as $requerimento)
                <tr>
                    <th scope="row">{{$requerimento->protocolo }}</th>

                    <td>{{$requerimento->tipo_requerimento}}</td>
                    <td>{{$requerimento->descricao}}</td>
                    <td>{{$requerimento->created_at->format('d/m/Y')}}</td>
                    <td class='text-center'>
                        <a href="{{route('requerimentos.show', ['requerimento' => $requerimento->id])}}" class="btn btn-primary btn-sm">Visualizar</a>
                    <td class='text-center'><a href="{{route('requerimentos.download', ['id' => $requerimento->id])}}" class="btn btn-success btn-sm">Download</a></td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection