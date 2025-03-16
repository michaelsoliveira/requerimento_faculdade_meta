<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodleUser extends Model
{
    protected $connection = 'mysql_moodle'; // Conecta ao BD do Moodle
    protected $table = 'user'; // Nome correto da tabela no Moodle
    protected $primaryKey = 'id';
}
     