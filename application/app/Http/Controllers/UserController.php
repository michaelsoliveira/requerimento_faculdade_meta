<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Requerimento;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->paginate(2);
        $requerimentos = Requerimento::all();
        

        return view('users.index', ['users' => $users, 'requerimentos' => $requerimentos]);
    }

    public function show(Request $request, User $user)
    {

        
        return view('users.show', ['user' => $user]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $request->validated();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing a senha corretamente
        ]);

        return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        $request->validated();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password
        ];

        if ($request->filled('password')) {
            // Gerar um salt aleatório
            $salt = bin2hex(random_bytes(16)); // Salt seguro e aleatório

            // Criar a senha criptografada no mesmo formato do Moodle
            $hashedPassword = crypt($request->password, '$6$rounds=10000$' . $salt . '$');

            $data['password'] = $hashedPassword;
        }

        $user->update($data);

        return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário editado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Usuário apagado com sucesso!');
    }
}
