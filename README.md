# Teste Prático Back-End - API RESTful
Teste prático Back | Desenvolvedor(a) Full Stack PHP

## Visão Geral

Desenvolver uma API REST com a última versão do laravel.


## Requerimentos:

* A API deverá conter uma forma de autenticação.
* A API deverá fazer operações CRUD de despesas.
* A entidade despesa deverá conter:
  * ID;
  * Descrição;
  * Data;
  * Usuário (deverá fazer relacionamento com a tabela usuarios);
  * Valor;
* As operações CRUD deverão estar protegidas por autenticação.
* A API deverá conter validação nos requests, sendo eles:
  * Usuário existe;
  * Data não é futura;
  * Valor não é negativo;
  * Descrição não ultrapassar 191 caracteres;
* A API deverá conter uma busca com filtro por usuário na listagem de todas as despesas.
* Ao cadastrar uma despesa, um email deverá ser enviado ao usuário.
* O email deverá ter o título "Despesa cadastrada" e ser enviado de forma assíncrona.


## Instalação

1. Instale as dependências necessárias `composer install`
2. Gere uma nova api key `php artisan key:generate`
3. Faça sua configuração do arquivo `.env`.
4. Crie as tabelas e usuários: `php artisan migrate --seed`
5. Execute o servidor: `php artisan serve`

## Como usar

Utilize o http header de autorização padrão para os testes: `Authorization: Bearer YWRtaW46YWRtaW4=`

* Para listar todas as despesas: `GET` `http://127.0.0.1:8000/api/despesas/`
* Listar as despesas de um usuário: `GET` `http://127.0.0.1:8000/api/despesas/{USUÁRIO}`
* Filtrar uma despesa por id: `GET` `http://127.0.0.1:8000/api/despesa/{ID}`
* Criar uma nova despesa: `POST` `http://127.0.0.1:8000/api/despesa/` `descricao={DESCRIÇÃO}&usuario={USUÁRIO}&data={DATA}&valor={VALOR}`
* Atualizar uma despesa: `PUT` `http://127.0.0.1:8000/api/despesa/{ID}` `descricao={DESCRIÇÃO}&usuario={USUÁRIO}&data={DATA}&valor={VALOR}`
* Remover uma despesa: `DELETE` `http://127.0.0.1:8000/api/despesa/{ID}`
