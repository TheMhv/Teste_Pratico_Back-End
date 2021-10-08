<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Usuarios;
use App\Models\Despesas;

use App\Mail\Email;

class DespesasController extends Controller
{
    // Funções do controller //

        private function retorno($code, $data = null, $message = null)
        {
            return response()->json([
                'code' => $code,
                'message' => $message,
                'data' => $data
            ], $code);
        }

        private function enviaEmail($usuario, $titulo, $mensagem)
        {
            // Recebe usuario
            $usuario = Usuarios::where('usuario', $usuario)->first();
            // Retorna um erro caso não o encontre
            if (empty($usuario)) return $this->retorno(400, null, 'Usuário não encontrado.');

            // Cria email
            $email = new Email([
                'usuario' => $usuario->usuario,
                'titulo' => $titulo,
                'mensagem' => $mensagem
            ]);

            // Envia email
            Mail::to($usuario->email)->send($email);
        }

    // -- //

    // Funções CRUD da API RESTful //

        public function index()
        {
            // Seleciona todas despesas
            $despesas = Despesas::all();

            // Retorna uma mensagem personalizada caso não existir despesas
            if ($despesas->isEmpty()) return $this->retorno(404, null, 'Nenhuma despesa foi encontrada.');

            // Retorna as despesas em uma lista
            return $this->retorno(200, $despesas);
        }

        // Create
        public function salvar(Request $request)
        {
            // Recebe e Valida os requests
            $usuario = Usuarios::where('usuario', $request->usuario)->first();
            if (!$usuario) return $this->retorno(400, null, 'Usuário não encontrado.');
            if (strtotime($request->data) > time()) return $this->retorno(400, null, 'A data da despesa não pode ser futura.');
            if (floatval($request->valor) < 0) return $this->retorno(400, null, 'O valor da despesa não pode ser negativo.');
            if (strlen($request->descricao) > 191) return $this->retorno(400, null, 'A descrição ultrapassou o limite de 191 caracteres.');

            // Cria a nova despesa
            $novaDespesa = new Despesas;
            $novaDespesa->usuario = $request->usuario;
            $novaDespesa->descricao = $request->descricao;
            $novaDespesa->data = $request->data;
            $novaDespesa->valor = $request->valor;

            // Salva a nova despesa
            if ($novaDespesa->save()) {
                // Envia um email para o usuário informando a nova despesa
                $this->enviaEmail($usuario, 'Despesa cadastrada', 'Informamos que uma nova despesa foi cadastrada para você.');

                // Retorna a despesa criada
                return $this->retorno(201, $novaDespesa, 'Despesa criada com sucesso.');
            }
        }

        // Read
        public function mostrar($id)
        {
            // Procura a despesa
            $despesa = Despesas::where('id', $id)->first();

            // Retorna um erro personalizado caso não a encontre
            if (empty($despesa)) return $this->retorno(404, null, 'Despesa não encontrada.');

            // Retorna a despesa
            return $this->retorno(200, $despesa);
        }

        public function filtrar($usuario)
        {
            // Recebe todas as despesas do usuário
            $despesas = Despesas::where('usuario', $usuario)->get();

            // Retorna uma mensagem personalizada caso o usuário não possuir despesas
            if ($despesas->isEmpty()) return $this->retorno(404, null, 'Usuário não possui despesas.');

            // Retorna todas as despesas do usuário
            return $this->retorno(200, $despesas);
        }

        // Update
        public function atualizar(Request $request, $id)
        {
            // Recebe e Valida os requests
            if (!empty($request->usuario)) {
                $usuario = Usuarios::where('usuario', $request->usuario)->first();
                if (!$usuario) return $this->retorno(400, null, 'Usuário não encontrado.');
            }
            if (!empty($request->data) && strtotime($request->data) > time()) return $this->retorno(400, null, 'A data da despesa não pode ser futura.');
            if (!empty($request->valor) && floatval($request->valor) < 0) return $this->retorno(400, null, 'O valor da despesa não pode ser negativo.');
            if (!empty($request->descricao) && strlen($request->descricao) > 191) return $this->retorno(400, null, 'A descrição ultrapassou o limite de 191 caracteres.');

            // Procura a despesa
            $despesa = Despesas::where('id', $id)->first();
            
            // Retorna um erro personalizado caso não a encontre
            if (empty($despesa)) return $this->retorno(404, null, 'Despesa não encontrada.');

            // Atualiza os dados da despesa
            $despesa = new Despesas;
            if (!empty($request->usuario)) $despesa->usuario = $request->usuario;
            if (!empty($request->descricao)) $despesa->descricao = $request->descricao;
            if (!empty($request->data)) $despesa->data = $request->data;
            if (!empty($request->valor)) $despesa->valor = $request->valor;

            // Retorna a despesa atualizada
            if ($despesa->save()) return $this->retorno(200, $despesa, 'Despesa atualizada com sucesso.');
        }

        // Delete
        public function remover($id)
        {
            // Procura a despesa
            $despesa = Despesas::where('id', $id)->first();

            // Retorna um erro personalizado caso não a encontre
            if (empty($despesa)) return $this->retorno(404, null, 'Despesa não encontrada.');

            // Retorna a despesa removida
            if ($despesa->delete()) return $this->retorno(200, $despesa, 'Despesa removida com sucesso.');
        }

    // -- //
}
