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
