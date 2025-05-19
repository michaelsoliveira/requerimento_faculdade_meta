@extends ('layouts.admin')

@section('content')
<div class="card-header" >
    <h2>tela do atendente</h2>
</div>


<div class="card-body">
        <x-alert />
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($users as $user)

                <tr>
                    <th> {{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm">Visualizar</a>
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="{{ route('user.destroy' , ['user' => $user->id]) }}" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('Tem certeza que deseja apagar esse registro?')">Apagar</button>
                        </form>
                    </td>
                </tr>

                @empty
                <div class="alert alert-danger" role="alert">
                    Nenhum usuário encontrado
                </div>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
