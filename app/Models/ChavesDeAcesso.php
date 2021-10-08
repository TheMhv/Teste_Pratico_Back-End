<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChavesDeAcesso extends Model
{
    protected $table = 'chaves_de_acesso';

    protected $fillable = [
        'api_key'
    ];
    
    public $timestamps = false;
}
