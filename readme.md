## Code.education - Curso Online de Laravel 5.1 com Ionic + Cordova
Repositório dos exercícios realizados durante o curso. Link com os detalhes do curso [aqui](http://sites.code.education/bf2016-laravel-com-ionic-cordova/).

## Fase 1 - Área administrativa

Agora que você já possui uma base para trabalharmos em nossa área administrativa, faça:

- Crie uma administração de Clientes (CRUD)
- Crie uma área de gerenciamento de pedidos (Listagem dos pedidos (e itens), edição de status e atribuição do entregador)

## Fase 2 - Checkout

Nessa fase, você deverá completar toda a área administrativa, bem como o checkout de um pedido, da mesma forma como foi apresentada no curso.

## Fase 3 - Criando autenticação para API

Nesta fase você deve criar a autenticação realizada no capítulo. Além disto, você deve criar também o agrupamento para as rotas da API e uma rota com URL /api/teste, sendo que esta rota deve estar protegida pelo OAuth.

Crie também um seeder com nome OAuthClientSeeder. Este seeder deve criar um registro na tabela oauth_clients, adicionando:
* id: appid01
* secret: secret
* app: Minha App Mobile
* created_at e updated_at com a data atual.
