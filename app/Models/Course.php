<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    //indicar o nome da tabela
    protected $table = 'courses';
    //indicar quais colunas poder ser cadastradas
    protected $fillable =
    [
        'name',
        'description'
    ];
    // criar um relacionamento entre um e muitos
    public function discipline()
    {
        return $this->hasMany(Discipline::class);
    }
    // o curso pode ter um ou mais disciplinas
}
