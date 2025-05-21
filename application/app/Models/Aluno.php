<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $fillable = [
        'pessoa_id',
        'matricula',
        'curso_id',
        'ano_ingresso',
        'status',
    ];

    public function pessoaFisica()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
