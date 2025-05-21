<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PessoaFisica extends Model
{
    use HasFactory;
    protected $table = 'pessoa_fisica';
    protected $primaryKey = 'pessoa_id';
    public $incrementing = false;

    protected $fillable = [
        'pessoa_id',
        'cpf',
        'rg',
        'data_nascimento',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }
}
