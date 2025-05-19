<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matricula',
        'course_id',
        'tipo_requerimento',
        'descricao',
        'anexo',
        'protocolo',
    ];

    //criar relacionamento entre um e muitos
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function disciplines()
{
    return $this->belongsToMany(Discipline::class, 'discipline_requerimento', 'requerimento_id', 'discipline_id');
}

}
