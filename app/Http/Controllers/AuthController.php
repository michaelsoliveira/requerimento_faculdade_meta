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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar usuário no banco principal
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Verifica a senha com SHA-512 + Salt
            if (strpos($user->password, '$6$') === 0 && hash_equals($user->password, crypt($request->password, $user->password))) {
                // Criar sessão e redirecionar
                session(['user' => $user, 'role' => $user->role]);
                return redirect()->route('user.index');
            }
            return redirect()->back()->with('error', 'Senha incorreta');
        }

        // Se não encontrou no banco principal, buscar no Moodle
        $moodleUser = MoodleUser::where('email', $request->email)->first();

        if (!$moodleUser) {
            return redirect()->back()->with('error', 'Usuário não encontrado');
        }

        // Verifica o formato do hash SHA-512 com Salt ($6$)
        if (strpos($moodleUser->password, '$6$') !== 0 || !hash_equals($moodleUser->password, crypt($request->password, $moodleUser->password))) {
            return redirect()->back()->with('error', 'Senha incorreta');
        }

        // Busca o papel do usuário no Moodle
        $role = DB::connection('mysql_moodle')->table('role_assignments')
            ->where('userid', $moodleUser->id)
            ->join('role', 'role.id', '=', 'role_assignments.roleid')
            ->select('role.shortname')
            ->first();

        // Se for aluno (webservice), adiciona ao banco principal
        if ($role && isset($role->shortname) && $role->shortname === 'webservice') {
            $user = User::create([
                'username' => $moodleUser->username,
                'name' => $moodleUser->firstname . ' ' . $moodleUser->lastname,
                'email' => $moodleUser->email,
                'role' => 'webservice',
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





//primeiro codigo
// namespace App\Http\Controllers;

// use App\Http\Requests\LoginRequest;
// use App\Http\Requests\UserRequest;
// use App\Models\User;
// use Exception;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

// class AuthController extends Controller
// {
//     public function index()
//     {
//         return view('login.index');
//     }

//     public function loginProcess(LoginRequest $request)
//     {
//         // Validar o formulário
//         $request->validated();

//         // Validar o usuário e a senha com as informações do banco de dados
//         $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

//         // Verificar se o usuário foi autenticado
//         if (!$authenticated) {
//             // Redirecionar o usuário para página anterior "login", enviar a mensagem de erro
//             return back()->withInput()->with('error', 'E-mail ou senha inválido!');
//         }

//         // Obter o usuário autenticado
//         $user = Auth::user();
//         $user = User::find($user->id);

//         // Redirecionar o usuário
//         return redirect()->route('user.index');
//     }

//     public function create()
//     {

//         // Carregar a VIEW
//         return view('login.create');
//     }

//     public function store(UserRequest $request)
//     {
//         // Validar o formulário
//         $request->validated();

//         // Marca o ponto inicial de uma transação
//         DB::beginTransaction();

//         try {

//             // Cadastrar no banco de dados na tabela usuários
//             User::create([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'password' => $request->password,
//             ]);

//             // Operação é concluída com êxito
//             DB::commit();

//             // Redirecionar o usuário, enviar a mensagem de sucesso
//             return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
//         } catch (Exception $e) {

//             // Operação não é concluída com êxito
//             DB::rollBack();

//             // Redirecionar o usuário, enviar a mensagem de erro
//             return back()->withInput()->with('error', 'Usuário não cadastrado!');
//         }
//     }


//     public function destroy()
//     {
//         // Deslogar o usuário
//         Auth::logout();

//         // Redirecionar o usuário, enviar a mensagem de sucesso
//         return redirect()->route('login')->with('success', 'Deslogado com sucesso!');
//     }
// }
