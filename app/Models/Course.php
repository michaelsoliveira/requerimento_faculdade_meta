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
    protected $fillable = ['name'];
}
