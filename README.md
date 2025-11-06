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


