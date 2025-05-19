<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodleUser extends Model
{
    protected $connection = 'mysql';
    protected $table = 'mdl_user';
    protected $primaryKey = 'id';
}
     