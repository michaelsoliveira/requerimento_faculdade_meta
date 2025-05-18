<?php

namespace App\Http\Controllers;

use App\Models\Requerimento;
use App\Models\Course;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequerimentoController extends Controller
{
    public function download($id)
    {
        $requerimento = Requerimento::findOrFail($id);

        if ($requerimento->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para acessar este arquivo.');
        }

        if (!$requerimento->anexo || !file_exists(storage_path("app/public/{$requerimento->anexo}"))) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->download(storage_path("app/public/{$requerimento->anexo}"));
    }

    public function getDisciplinasPorCurso($id)
    {
        $disciplinas = Discipline::where('course_id', $id)->get();
        return response()->json($disciplinas);
    }

    public function index()
    {
        $user = auth()->user();
        $requerimentos = Requerimento::where('user_id', $user->id)->orderByDesc('id')->paginate(100);
        return view('requerimentos.index', compact('requerimentos'));
    }

    public function show(Requerimento $requerimento)
    {
        $requerimentos = $requerimento;
        return view('requerimentos.show', compact('requerimentos'));
    }

    public function create()
    {
        $courses = Course::orderBy('id', 'asc')->get();
        $user = auth()->user();
        return view('requerimentos.create', compact('courses', 'user'));
    }

    public function store(Request $request , Requerimento $requerimento)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'tipo_requerimento' => 'required|string',
            'descricao' => 'required|string',
            'anexo' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
            'protocolo' => 'nullable|string',
            'discipline_id' => 'nullable|array',
            'discipline_id.*' => 'exists:discipline,id', // corrigido de disciplines -> discipline
        ]);

        $anexoPath = null;
        if ($request->hasFile('anexo')) {
            $anexoPath = $request->file('anexo')->store('anexos', 'public');
        }

        $user = auth()->user();

        $requerimento = Requerimento::create([
            'user_id' => $user->id,
            'matricula' => $user->username,
            'course_id' => $request->course_id,
            'tipo_requerimento' => $request->tipo_requerimento,
            'descricao' => $request->descricao,
            'anexo' => $anexoPath,
            'protocolo' => null,
        ]);
        

       $requerimento = Requerimento::with('disciplines')->findOrFail($requerimento->id);
        

        $protocolo = 'REQ-' . Carbon::now()->format('dmY') . '-' . str_pad($requerimento->id, 2, '0', STR_PAD_LEFT);
        $requerimento->update(['protocolo' => $protocolo]);

        if ($request->has('discipline_id')) {
            $requerimento->discipline()->attach($request->input('discipline_id'));
        }

        return redirect()->route('requerimentos.index')
            ->with('success', "Requerimento enviado com sucesso! Seu protocolo de atendimento foi gerado: $protocolo");
    }
}
