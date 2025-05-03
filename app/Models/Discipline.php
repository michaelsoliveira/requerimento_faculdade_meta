<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;
    protected $table = 'discipline';

    protected $fillable = [
        'name',
        'description',
        'course_id',
    ];
    //criar relacionamento entre um e muitos
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    //o disciplina pode 
}
