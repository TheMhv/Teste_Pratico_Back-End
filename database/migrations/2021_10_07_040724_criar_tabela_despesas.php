<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaDespesas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar tabela despesas
        Schema::create('despesas', function (Blueprint $table) {
            $table->id(); // ID da despesa
            $table->text('descricao'); // Descrição da despesa
            $table->datetime('data'); // Data da criação da despesa
            $table->string('usuario', 50); // Usuário dono da despesa
            $table->unsignedDecimal('valor', 10, 2); // Valor da despesa

            $table->foreign('usuario')->references('usuario')->on('usuarios')->onDelete('cascade'); // Chave estrangeira relacionando com a tabela `usuarios`
            
            $table->index('usuario'); // Indexação da coluna `usuario` para eventual consulta
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
