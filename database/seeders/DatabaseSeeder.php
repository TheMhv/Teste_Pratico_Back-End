<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table("usuarios")->insert([
            'usuario' => 'test_user',
            'senha'=> hash('sha256', 'test_user'),
            'email' => 'test@email.com'
        ]);

        DB::table("chaves_de_acesso")->insert([
            'api_key' => base64_encode('admin:admin') // {usuário}:{senha} criptografados em base 64
        ]);
    }
}
