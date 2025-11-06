# API de Postagens com Laravel e JWT

Este projeto é uma **API RESTful** construída com **Laravel 12**, utilizando **JWT (JSON Web Token)** para autenticação de usuários. A API permite registrar e autenticar usuários, criar, atualizar, visualizar e deletar posts.

---

## 🚀 Funcionalidades

- Registro de usuários
- Login e emissão de token JWT
- Logout (invalida o token)
- Consultar perfil do usuário logado
- CRUD completo de posts
  - Criar post (autenticado)
  - Atualizar post (autenticado, apenas autor)
  - Deletar post (autenticado, apenas autor)
  - Listar posts (público)
  - Visualizar post específico (público)
- Paginação de posts
- Resposta padronizada em JSON

---

## 🛠 Tecnologias utilizadas

- Laravel 12
- MySQL
- PHP 8+
- JWT Auth (tymon/jwt-auth)
- Composer
- Postman (para testes)

---

## 🔧 Instalação

1. Clone o repositório:

```bash
git clone https://github.com/Jorge-Risso/api_postagens.git
cd api_postagens


composer install

```


## Configure o arquivo .env:
```bash
APP_NAME=
APP_URL=

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

JWT_SECRET=

````

## Gere a chave da aplicação Laravel:

```bash
php artisan key:generate

```
Gere o segredo do JWT:
```bash
php artisan jwt:secret
```

Rode as migrations para criar as tabelas do banco:
```bash
php artisan migrate
```

Inicie o servidor local:
```bash
php artisan serve

```

Rotas da API

Prefixo: /api/v1

Autenticação
Método	Rota	Descrição
POST	/register	Registrar usuário
POST	/login	Login do usuário
POST	/logout	Logout do usuário
GET	/profile	Perfil do usuário logado
Posts
Método	Rota	Descrição	Autenticação
GET	/posts	Listar posts com paginação	Não
GET	/posts/{id}	Visualizar um post específico	Não
POST	/posts	Criar novo post	Sim
PUT	/posts/{id}	Atualizar post existente	Sim
DELETE	/posts/{id}	Deletar post	Sim


Exemplo de Requisições

Registro

```bash

POST /api/v1/register
Content-Type: application/json

{
    "name": "Teste Teste",
    "email": "teste@teste.com",
    "password": "123456",
    "password_confirmation": "123456"
}



