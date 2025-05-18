@extends ('layouts.admin')

@section('content')

<h2>Detalhes da Disciplina</h2>

<a href="{{ route('discipline.index', ['course' => $discipline->course_id]) }}">
    <button type="button">Listar disciplinas</button>
</a>



ID: {{ $discipline->id }}<br>
Nome da disciplina: {{ $discipline->name }}<br>
Descrição: {{ $discipline->description }}<br>
Curso: {{ $discipline->course->name }}<br>
Cadastrado: {{ \Carbon\Carbon::parse($discipline->created_at)->format('d/m/Y H:i:s') }}<br>
Editado: {{ \Carbon\Carbon::parse($discipline->updated_at)->format('d/m/Y H:i:s') }}<br><br>


@endsection
