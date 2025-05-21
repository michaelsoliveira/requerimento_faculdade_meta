<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PessoaJuridica extends Model
{
    use HasFactory;
    protected $table = 'pessoa_juridica';
    protected $primaryKey = 'pessoa_id';
    public $incrementing = false;

    protected $fillable = [
        'pessoa_id',
        'cnpj',
        'razao_social',
        'inscricao_estadual',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
