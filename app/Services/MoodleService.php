<?php 

// app/Services/MoodleService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoodleService
{
    protected $moodleUrl;
    protected $token;

    public function __construct()
    {
        $this->moodleUrl = env('MOODLE_URL', 'https://localhost/moodle'); // Agora pega do .env corretamente
        $this->token = env('MOODLE_TOKEN', '39192bd02dffc3e747e3c8de7a9322ce');
    }

 
    /**
     * Função para obter informações do usuário usando o core_user_get_users
     */
    public function getUserInfoByEmail($login)
    {
        $key = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username;';
        // Fazendo a requisição à API do Moodle
        $response = Http::get($this->moodleUrl, [
            'wstoken' => $this->token,  // Token de autenticação
            'wsfunction' => 'core_user_get_users',  // Função da API
            'moodlewsrestformat' => 'json',  // Formato de resposta (JSON)
            'criteria[0][key]' => $key,  // Critério para busca: e-mail
            'criteria[0][value]' => $login,  // E-mail ou username do usuário
        ]);


    // Verificando a resposta da API
    dd($response->json());  // Verifica a resposta da API para depuração

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return $response->json();  // Retorna os dados do usuário
        }

        // Se falhar, retorna null
        return null;
    }

    /**
     * Função para pegar os cursos de um usuário
     */
    public function getUserCourses($userId)
    {
        // Fazendo a requisição para obter os cursos do usuário
        $response = Http::get($this->moodleUrl, [
            'wstoken' => $this->token,
            'wsfunction' => 'core_enrol_get_users_courses',  // Função para pegar os cursos
            'moodlewsrestformat' => 'json',
            'userid' => $userId,  // ID do usuário
        ]);
        

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return $response->json();  // Retorna a lista de cursos
        }

        return null;
    }
}