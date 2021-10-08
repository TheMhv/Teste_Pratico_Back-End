<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    protected $table = 'despesas';

    protected $fillable = [
        'descricao',
        'data',
        'usuario',
        'valor'
    ];
    
    public $timestamps = false;
}
