<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'email'
    ];

    protected $hidden = [
        'senha'
    ];
    
    public $timestamps = false;
}
