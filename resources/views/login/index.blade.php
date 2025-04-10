@extends('layouts.auth')

@section('content')

<main class="form-signin w-100 m-auto text-center bg-light rounded">
    <img class="mb-4" src="{{asset('img/logofaculdade.svg')}}" alt="" width="300" height="72">
    <h1 class="h3 mb-3 fw-normal">Área Restrita</h1>
    <x-alert />
    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-floating mb-4">
            <input type="text" name="username" required class="form-control" id="username" placeholder="Digite sua matricula valida" value="{{ old('username') }}">
            <label for="username">Matrícula</label>
        </div>


        <div class="mb-4">
            <div class="input-group">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="password" value="">
                    <label for="password">Senha</label>
                </div>
                <span class="input-group-text" role="button" onclick="togglePassword('password', this)"><i class="bi bi-eye"></i></span>
            </div>
        </div>
        <!-- <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Lembrar-me
            </label>
        </div> -->
        <button class="btn btn-primary w-100 py-2 mb-4" type="submit">Acessar</button>
        <!-- <p class="mt-5 mb-3 text-body-secondary">&copy; </p> -->

        <a href="{{ route('password.request') }}" class="text-decoration-none">Alterar Senha</a>
    </form>
</main>

@endsection