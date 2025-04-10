@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Permissões</h2>

    <form action="{{ route('permissions.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Nome da permissão">
            <button class="btn btn-primary">Adicionar</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Excluir</button> <br>
                    </form>
                    
                    <br><button class="btn btn-warning btn-sm">Editar</button>
                    <button class="btn btn-primary btn-sm">Visualizar</button>
                    <button class="btn btn-info btn-sm">Permissoes</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection