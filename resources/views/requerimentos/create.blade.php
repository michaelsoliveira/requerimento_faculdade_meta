<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <<!-- resources/views/requerimentos/create.blade.php -->

        @extends('layouts.admin')

        @section('content')
        <div class="card mt-4 mb-4">
            <div class="card-header">
                <h2>Criar Novo Requerimento</h2>
            </div>
            <div class="card-body">
                <fom action="{{ route('requerimentos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="disciplina" class="form-label">Disciplina</label>
                        <input type="text" class="form-control" name="disciplina" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Requerimento</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="volvo">declaração</option>
                            <option value="saab">trancamento</option>
                            <option value="mercedes">correção de nota</option>
                            <option value="audi">outro</option>
                        </select>
                    </div>
                    <div class="mb-3">r
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="anexo" class="form-label">Anexo (opcional)</label>
                        <input type="file" class="form-control" name="anexo">
                    </div>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
            </div>
        </div>
        @endsection



</body>

</html>