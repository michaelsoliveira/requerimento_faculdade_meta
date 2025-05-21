<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    protected $table = 'disciplina';

    protected $fillable = [
        'nome',
        'descricao',
        'cargo_horaria',
        'course_id',
    ];
    //criar relacionamento entre um e muitos
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function requerimentos()
    {
        return $this->belongsToMany(Requerimento::class, 'disciplina_requerimento', 'disciplina_id', 'requerimento_id');
    }

}
