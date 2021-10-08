<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar tabela usuários
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID do Usuário
            $table->string('usuario', 50); // Nome de usuário
            $table->string('senha', 64); // Senha do usuário (criptografado em sha256 para proteção dos dados)
            $table->string('email', 320); // Email para contato

            $table->index('usuario'); // Indexação da coluna `usuario` para eventual consulta

            $table->unique('usuario'); // Garantir que todos os usuários cadastrados sejam diferentes
            $table->unique('email'); // Garantir que todos os emails cadastrados sejam diferentes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
