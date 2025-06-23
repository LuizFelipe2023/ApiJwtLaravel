# API de Autenticação JWT com Laravel 12 e PHP 8.2

## Descrição

API simples para autenticação de usuários usando JWT (JSON Web Token), construída com Laravel 12 e PHP 8.2. Permite registro, login, logout e refresh de token, protegendo rotas via middleware.

## Funcionalidades

- Registro de usuário com senha hasheada
- Login retornando token JWT e dados do usuário
- Logout invalidando o token
- Refresh para gerar novo token JWT antes do atual expirar
- Endpoint para retorno do perfil autenticado

## Tecnologias Utilizadas

- Laravel 12
- PHP 8.2
- PHP Open Source Saver JWT-Auth (jwt-auth)
- Eloquent ORM
- Middleware de autenticação JWT
- Laravel Resources para formatar respostas JSON

## Endpoints Principais

| Método | Rota         | Protegido? | Descrição                   |
|--------|--------------|------------|-----------------------------|
| POST   | /api/register| Não        | Cadastrar novo usuário       |
| POST   | /api/login   | Não        | Login e retorno do token JWT |
| POST   | /api/logout  | Sim        | Logout e invalida token      |
| POST   | /api/refresh | Sim        | Gera novo token JWT          |
| GET    | /api/profile | Sim        | Retorna perfil do usuário    |

## Funcionamento

1. Usuário se registra ou faz login.
2. Recebe token JWT que deve ser enviado em Authorization Bearer nas requisições protegidas.
3. Pode fazer logout para invalidar token.
4. Pode fazer refresh para renovar token antes de expirar.
5. Consultas protegidas retornam dados somente se token válido for enviado.

---
