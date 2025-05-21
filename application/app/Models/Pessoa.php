<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class Pessoa extends Model
{
    use UseUuid;
    protected $table = 'pessoa';
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco_id',
        'tipo',
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function pessoaFisica()
    {
        return $this->hasOne(PessoaFisica::class);
    }

    public function pessoaJuridica()
    {
        return $this->hasOne(PessoaJuridica::class);
    }

}
