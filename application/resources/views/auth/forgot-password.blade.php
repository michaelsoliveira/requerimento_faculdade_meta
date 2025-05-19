@extends('layouts.admin') {{-- Use seu layout principal --}}

@section('content')
<div class="container mt-5">
    <h2>Recuperar Senha</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Seu e-mail cadastrado:</label>
            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
        </div>
        <button type="submit" class="btn btn-primary">Enviar link de redefinição</button>
    </form>
</div>
@endsection
