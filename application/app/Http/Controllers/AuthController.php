<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Exception;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $response = Http::asForm()->post(env('MOODLE_URL') . '/login/token.php', [
            'username' => $request['username'],
            'password' => $request['password'],
            'service' => env('MOODLE_SERVICE_NAME', 'moodle_mobile_app'),
        ]);

        if ($response->failed() || isset($response['error'])) {
            throw ValidationException::withMessages([
                'username' => ['Credenciais inválidas.'],
            ]);
        }

        $token = $response['token'];

        $userResponse = Http::get(env('MOODLE_URL') . '/webservice/rest/server.php', [
            'wstoken' => $token,
            'wsfunction' => 'core_webservice_get_site_info',
            'moodlewsrestformat' => 'json',
        ]);

        if ($userResponse->failed()) {
            throw ValidationException::withMessages([
                'username' => ['Erro ao buscar dados do Moodle.'],
            ]);
        }

        $moodleUser = $userResponse->json();

        $user = User::updateOrCreate(
            ['username' => $moodleUser['username']],
            [
                'name' => $moodleUser['fullname'],
                'email' => $moodleUser['username'] . '@meta.edu.br', // Moodle nem sempre retorna email
                'username' => $moodleUser['username'],
            ]
        );

        // 4. Gera o token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
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
