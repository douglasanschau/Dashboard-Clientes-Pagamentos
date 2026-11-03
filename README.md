# 💳 Dashboard de Clientes e Pagamentos

Sistema web para gerenciamento de clientes e controle de pagamentos, desenvolvido com Laravel e JavaScript.

O projeto tem como objetivo centralizar o cadastro de clientes, acompanhar suas situações financeiras e administrar pagamentos, disponibilizando um dashboard com indicadores para facilitar o acompanhamento das informações.

## 📌 Funcionalidades

### 📊 Dashboard

Painel com indicadores gerais da operação:

- Total de clientes cadastrados.
- Quantidade de clientes ativos.
- Quantidade de clientes inadimplentes.
- Quantidade de clientes bloqueados.
- Indicadores de pagamentos realizados e pendentes.
- Visualização resumida da situação dos pagamentos.

### 👥 Gestão de Clientes

- Cadastro de clientes.
- Listagem de clientes.
- Edição de informações cadastrais.
- Exclusão de clientes.
- Classificação por situação:
  - Ativo;
  - Inadimplente;
  - Bloqueado.

### 💰 Gestão de Pagamentos

- Cadastro de pagamentos vinculados a clientes.
- Definição de data de vencimento e valor.
- Listagem de pagamentos.
- Identificação de pagamentos pendentes e realizados.
- Atualização do status para pago.
- Exclusão de pagamentos.
- Identificação de pagamentos em aberto e vencidos.

## 🛠️ Tecnologias Utilizadas

### Backend

- PHP
- Laravel
- Laravel Eloquent ORM
- MySQL

### Frontend

- HTML5
- CSS3
- JavaScript
- jQuery
- AJAX
- Blade Templates
- Bootstrap

## 🏗️ Arquitetura e Organização

O projeto utiliza uma organização em camadas, separando responsabilidades entre controllers, models, views e rotas.

```text
Dashboard-Clientes-Pagamentos/
│
├── Controllers/
│   ├── Controller.php
│   ├── Clientes.php
│   └── Pagamentos.php
│
├── Models/
│   ├── Financeiro.php
│   ├── Pagamento.php
│   └── User.php
│
├── migrations/
│   ├── create_financeiros_table.php
│   └── create_pagamentos_table.php
│
├── routes/
│   ├── api.php
│   ├── web.php
│   └── console.php
│
├── views/
│   ├── dashboard.blade.php
│   ├── clients.blade.php
│   ├── payments.blade.php
│   └── welcome.blade.php
│
├── js/
│   ├── app.js
│   └── dash.js
│
├── app.css
├── login.css
└── style.css
```

## 🗄️ Modelagem de Dados

O sistema trabalha principalmente com duas entidades:

**Financeiros (Clientes)**

Armazena os clientes cadastrados e suas respectivas situações.

Principais campos:
- `id`: identificador do cliente.
- `name`: nome do cliente.
- `status`: situação cadastral/financeira.
- `created_at` e `updated_at`: datas de criação e atualização.

**Pagamentos**

Armazena os pagamentos associados aos clientes.

Principais campos:
- `id`: identificador do pagamento.
- `client`: referência ao cliente.
- `date`: data de vencimento.
- `price`: valor do pagamento.
- `status`: situação do pagamento.
- `created_at` e `updated_at`: datas de criação e atualização.

Relacionamento:

```text
Financeiros (1) ─────── (N) Pagamentos
```

Um cliente pode possuir diversos pagamentos associados.

## 🔌 API REST

O projeto disponibiliza rotas para operações CRUD de clientes e pagamentos.

### Clientes

| Método | Endpoint | Descrição |
|---|---|---|
| GET | `/api/clients` | Lista os clientes |
| POST | `/api/clients` | Cadastra um cliente |
| GET | `/api/clients/{id}` | Consulta um cliente |
| PUT | `/api/clients/{id}` | Atualiza um cliente |
| DELETE | `/api/clients/{id}` | Exclui um cliente |

### Pagamentos

| Método | Endpoint | Descrição |
|---|---|---|
| GET | `/api/payments` | Lista os pagamentos |
| POST | `/api/payments` | Cadastra um pagamento |
| GET | `/api/payments/{id}` | Consulta um pagamento |
| PUT | `/api/payments/{id}` | Atualiza um pagamento |
| DELETE | `/api/payments/{id}` | Exclui um pagamento |

## 🧠 Conceitos Aplicados

Durante o desenvolvimento foram trabalhados conceitos importantes de desenvolvimento web:

- Arquitetura MVC.
- Desenvolvimento de APIs REST.
- Operações CRUD.
- Relacionamentos entre entidades com Eloquent ORM.
- Requisições assíncronas utilizando AJAX e jQuery.
- Manipulação dinâmica do DOM.
- Integração entre frontend e backend.
- Migrations para estruturação do banco de dados.
- Organização de responsabilidades entre controllers, models e views.

## 🚀 Execução do Projeto

O código disponível neste repositório contém componentes da aplicação Laravel, mas não inclui todos os arquivos necessários para inicializar um projeto Laravel completo, como `composer.json`, `artisan` e os arquivos de bootstrap.

Para executar a aplicação, é necessário disponibilizar a estrutura completa do projeto Laravel correspondente, configurar o ambiente PHP e o banco de dados MySQL e aplicar as migrations existentes.

## 👨‍💻 Autor

**Douglas Anschau**

Desenvolvedor Full Stack

- GitHub: [douglasanschau](https://github.com/douglasanschau)

---

Projeto desenvolvido com o objetivo de praticar desenvolvimento backend com PHP/Laravel, integração com JavaScript e gerenciamento de dados financeiros.
