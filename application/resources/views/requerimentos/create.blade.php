@extends('layouts.admin')

@section('content')
<div class="card mt-4 mb-4">
    <div class="card-header">
        <h2>Criar Novo Requerimento</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('requerimentos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="course_id" class="form-label">Curso</label>
                <select class="form-select form-select-sm" id="course_id" name="course_id" required>
                    <option value="" disabled selected>Selecione um curso</option>
                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Tipo de Requerimento fixo, não vem do banco então não precisa ser dinâmico  -->
            <div class="mb-3">
                <label for="tipo_requerimento">Tipo de Requerimento</label>
                <select class="form-select form-select-sm" name="tipo_requerimento" id="tipo_requerimento" required>
                    <option value="" disabled selected>Selecione o tipo de requerimento</option>
                    <option value="Trancamento">Trancamento</option>
                    <option value="Cancelamento">Cancelamento</option>
                    <option value="Justificativa de Falta">Justificativa de Falta</option>
                    <option value="Transferência Externa">Transferência Externa</option>
                    <option value="Ementas">Ementas</option>
                    <option value="Segunda Via de Diploma e Certificado">Segunda Via de Diploma e Certificado</option>
                    <option value="Reabertura de Matrícula">Reabertura de Matrícula</option>
                    <option value="Reembolso">Reembolso</option>
                    <option value="Correção de Nota">Correção de Nota</option>
                    <option value="Solicitação de Desconto">Solicitação de Desconto</option>
                    <option value="Cursar Disciplina Pendente">Cursar Disciplina Pendente</option>
                    <option value="Crédito de Disciplina">Crédito de Disciplina</option>
                    <option value="Declaração de Matrícula">Declaração de Matrícula</option>
                    <option value="Histórico Escolar">Histórico Escolar</option>
                    <option value="Declaração de Estágio">Declaração de Estágio</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            <!-- Campo Disciplina (oculto por padrão) -->
            <div class="mb-3" id="campo_disciplina" style="display: none;">
                <label for="discipline_id">Disciplina</label>
                <select id="discipline_id" name="discipline_id[]" class="form-select form-select-sm" multiple>
                    <option value="" disabled selected>Selecione a disciplina</option>
                    <!-- adicione as discipline_ids reais -->
                </select>
                <small>Segure Ctrl (ou Cmd no Mac) para selecionar várias disciplinas</small>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="anexo" class="form-label">Anexo (opcional)</label>
                <input type="file" class="form-control" name="anexo" accept=".pdf,.jpg,.png">
            </div>

            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('tipo_requerimento').addEventListener('change', function() {
        const campoDisciplina = document.getElementById('campo_disciplina');
        const requerimentosComDisciplina = [
            'Correção de Nota',
            'Cursar Disciplina Pendente',
            'Crédito de Disciplina'
        ];

        if (requerimentosComDisciplina.includes(this.value)) {
            campoDisciplina.style.display = 'block';
        } else {
            campoDisciplina.style.display = 'none';
            document.getElementById('disciplina').value = '';
        }
    });
</script>

<script>
    document.getElementById('course_id').addEventListener('change', function() {
        const courseId = this.value;
        const disciplinaSelect = document.getElementById('discipline_id');

        // Limpa as opções anteriores
        disciplinaSelect.innerHTML = '<option value="" disabled selected>Carregando disciplinas...</option>';

        // Faz a requisição AJAX
        fetch(`/disciplinas-por-curso/${courseId}`)
            .then(response => response.json())
            .then(data => {
                disciplinaSelect.innerHTML = '<option value="" disabled selected>Selecione a disciplina</option>';
                data.forEach(disciplina => {
                    const option = document.createElement('option');
                    option.value = disciplina.id;
                    option.textContent = disciplina.name;
                    disciplinaSelect.appendChild(option);
                });
            })
            .catch(error => {
                disciplinaSelect.innerHTML = '<option value="">Erro ao carregar disciplinas</option>';
                console.error(error);
            });
    });
</script>

@endsection