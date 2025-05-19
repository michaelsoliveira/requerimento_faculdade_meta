<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\MoodleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Services\MoodleService;
use Exception;


class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        // Validar o formulário
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Buscar usuário no banco principal pelo 'username'
        $user = User::where('username', $request->username)->first();

        if ($user) {
            // Verifica a senha com SHA-512 + Salt
            if (strpos($user->password, '$6$') === 0 && hash_equals($user->password, crypt($request->password, $user->password))) {
                // Criar sessão e redirecionar
                // session(['user' => $user, 'role' => $user->role]);
                Auth::login($user);

                return redirect()->route('user.index');
            }
            return redirect()->back()->withInput()->with('error', 'Senha incorreta');
        }

        // Se não encontrou no banco principal, buscar no Moodle
        $moodleUser = MoodleUser::where('username', $request->username)->first();  

        if (!$moodleUser) {
            return redirect()->back()->withInput()->with('error', 'Usuário não encontrado');
        }

        // Verifica o formato do hash SHA-512 com Salt ($6$)
        if (strpos($moodleUser->password, '$6$') !== 0 || !hash_equals($moodleUser->password, crypt($request->password, $moodleUser->password))) {
            return redirect()->back()->with('error', 'Senha incorreta');
        }

        // Busca o papel do usuário no Moodle
        $role = DB::connection('mysql')->table('mdl_role_assignments')
            ->where('userid', $moodleUser->id)
            ->join('mdl_role', 'mdl_role.id', '=', 'mdl_role_assignments.roleid')
            ->select('mdl_role.shortname')
            ->first();

        // Se for aluno (webservice), adiciona ao banco principal
        if ($role && isset($role->shortname) && $role->shortname === 'manager') {
            $user = User::create([
                'username' => $moodleUser->username,
                'name' => $moodleUser->firstname . ' ' . $moodleUser->lastname,
                'email' => $moodleUser->email,
                'role' => 'manager',
                'password' => $moodleUser->password, // Armazena exatamente como no Moodle (SHA-512 + salt)
            ]);

            // Criar sessão e redirecionar
            session(['user' => $user, 'role' => 'aluno']);
            return redirect()->route('user.index');
        }

        return redirect()->back()->with('error', 'Usuário sem permissão adequada');
    }

    public function create()
    {
        return view('login.create');
    }

    public function store(UserRequest $request)
    {
        $request->validated();

        DB::beginTransaction();
        try {
            // Gerando a senha corretamente
            $hashedPassword = password_hash($request->password, PASSWORD_DEFAULT);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Deslogado com sucesso!');
    }
}
