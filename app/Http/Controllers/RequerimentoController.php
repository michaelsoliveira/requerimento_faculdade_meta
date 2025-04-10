<?php


namespace App\Http\Controllers;

use App\Models\Requerimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequerimentoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');  // Garante que apenas usuários autenticados possam acessar
    // }

    // Exibir lista de requerimentos
    public function index()
    {
        // Exibe todos os requerimentos do usuário autenticado
        $requerimentos = Requerimento::where('user_id', Auth::id())->orderByDesc('created_at')->paginate(10);
        return view('requerimentos.index', compact('requerimentos'));
    }

    // Exibir o formulário de criação de requerimento
    public function create()
    {
        return view('requerimentos.create');
    }

    // Salvar o novo requerimento
    public function store(Request $request)
    {
        $request->validate([
            'disciplina' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        // Obtendo os dados do usuário do Moodle
        $user = Auth::user();
        $moodleUser = DB::connection('moodle')->table('mdl_user')
            ->where('email', $user->email)
            ->first();

        if (!$moodleUser) {
            return redirect()->route('requerimentos.create')->with('error', 'Usuário não encontrado no banco do Moodle.');
        }

        // Buscando o curso do usuário
        $userCourse = DB::connection('moodle')->table('mdl_enrol')
            ->join('mdl_course', 'mdl_enrol.courseid', '=', 'mdl_course.id')
            ->where('mdl_enrol.userid', $moodleUser->id)
            ->first();

        if (!$userCourse) {
            return redirect()->route('requerimentos.create')->with('error', 'Curso não encontrado para o usuário no Moodle.');
        }

        // Criando o requerimento
        Requerimento::create([
            'user_id' => Auth::id(),
            'nome' => $moodleUser->firstname . ' ' . $moodleUser->lastname,
            'email' => $moodleUser->email,
            'curso' => $userCourse->fullname ?? 'Curso não encontrado',
            'disciplina' => $request->disciplina,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'status' => 'pendente',
        ]);

        return redirect()->route('requerimentos.index')->with('success', 'Requerimento enviado com sucesso!');
    }

    // Exibir os detalhes de um requerimento
    public function show($id)
    {
        $requerimento = Requerimento::findOrFail($id);
        return view('requerimentos.show', compact('requerimento'));
    }

    // Exibir o formulário de edição de um requerimento
    public function edit($id)
    {
        $requerimento = Requerimento::findOrFail($id);
        return view('requerimentos.edit', compact('requerimento'));
    }

    // Atualizar um requerimento
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pendente,aprovado,negado',
        ]);

        $requerimento = Requerimento::findOrFail($id);
        $requerimento->update([
            'status' => $request->status,
        ]);

        return redirect()->route('requerimentos.index')->with('success', 'Requerimento atualizado!');
    }

    // Remover um requerimento
    public function destroy($id)
    {
        $requerimento = Requerimento::findOrFail($id);
        $requerimento->delete();
        
        return redirect()->route('requerimentos.index')->with('success', 'Requerimento removido!');
    }
}
