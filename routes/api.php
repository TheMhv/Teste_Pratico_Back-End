<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DespesasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rotas da API //

    // Listar todas as despesas
    Route::get('despesas', [DespesasController::class, 'index'])->middleware('API_Auth');

    // Listar todas despesas de um usuário
    Route::get('despesas/{usuario}', [DespesasController::class, 'filtrar'])->middleware('API_Auth');

    // Mostrar uma despesa específica
    Route::get('despesa/{id}', [DespesasController::class, 'mostrar'])->middleware('API_Auth');

    // Criar uma nova despesa
    Route::post('despesa', [DespesasController::class, 'salvar'])->middleware('API_Auth');

    // Atualizar uma despesa
    Route::put('despesa/{id}', [DespesasController::class, 'atualizar'])->middleware('API_Auth');

    // Remover uma despesa
    Route::delete('despesa/{id}', [DespesasController::class, 'remover'])->middleware('API_Auth');

// -- //