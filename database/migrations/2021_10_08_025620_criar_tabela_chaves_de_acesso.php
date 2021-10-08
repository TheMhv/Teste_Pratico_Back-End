<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaChavesDeAcesso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaves_de_acesso', function (Blueprint $table) {
            $table->id(); // ID da chave de acesso
            $table->string('api_key', 128); // Chave de acesso do usuario

            $table->index('api_key'); // Indexação da coluna `api_key` para eventual consulta

            $table->unique('api_key'); // Garantir que todas as chaves de acesso cadastradas sejam diferentes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chaves_de_acesso');
    }
}
