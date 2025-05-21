<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'requerimento_id',
        'tipo',
        'name',
        'path',
        'size'
    ];

    public function requerimento()
    {
        return $this->belongsTo(Requerimento::class);
    }
}
