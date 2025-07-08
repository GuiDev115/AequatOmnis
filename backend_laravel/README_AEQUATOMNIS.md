# AequatOmnis Backend - Laravel

Backend API em Laravel para o sistema de vendas de jogos AequatOmnis.

## Migração do Node.js para Laravel

Este backend foi migrado de Node.js/Express/MongoDB para Laravel/MySQL, mantendo total compatibilidade com o frontend Vue.js existente.

### Principais mudanças:

- **Framework**: Express.js → Laravel 11
- **Banco de dados**: MongoDB → MySQL/SQLite
- **Autenticação**: JWT manual → Laravel Sanctum
- **Estrutura**: Controllers customizados → Resource Controllers do Laravel

## Funcionalidades

- **Autenticação JWT** com Laravel Sanctum
- **CRUD de Jogos** (titulo, descrição, empresa, gênero, plataforma, valor, estoque)
- **CRUD de Vendas** (nome_produto, comprador, email, total)
- **Gestão de Usuários** com perfil de administrador
- **Upload de imagens** para jogos
- **Recuperação de senha** por email
- **CORS** configurado para frontend Vue.js

## Instalação

```bash
# Clone o repositório (se necessário)
git clone <url-do-repo>

# Entre na pasta do backend
cd backend_laravel

# Instale as dependências PHP
composer install

# Instale as dependências Node.js (opcional, para assets)
npm install

# Configure o arquivo .env
cp .env.example .env
php artisan key:generate

# Execute as migrations e seeders
php artisan migrate:fresh --seed

# Inicie o servidor
php artisan serve --host=0.0.0.0 --port=8000
```

## Configuração do Banco

Por padrão, o projeto usa SQLite. Para usar MySQL:

1. Edite o arquivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aequatomnis
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

2. Execute as migrations:
```bash
php artisan migrate:fresh --seed
```

## Rotas da API

### Autenticação
- `POST /api/register` - Registrar usuário
- `POST /api/login` - Login
- `POST /api/logout` - Logout (protegida)
- `GET /api/me` - Dados do usuário autenticado (protegida)
- `POST /api/forgot-password` - Recuperar senha
- `POST /api/reset-password` - Redefinir senha

### Jogos
- `GET /api/jogos` - Listar jogos
- `POST /api/jogos` - Criar jogo
- `GET /api/jogos/{id}` - Visualizar jogo
- `PUT /api/jogos/{id}` - Atualizar jogo
- `DELETE /api/jogos/{id}` - Deletar jogo
- `POST /api/jogos/{id}/featured-image` - Upload imagem do jogo

### Vendas
- `GET /api/vendas` - Listar vendas
- `POST /api/vendas` - Criar venda
- `GET /api/vendas/{id}` - Visualizar venda
- `PUT /api/vendas/{id}` - Atualizar venda
- `DELETE /api/vendas/{id}` - Deletar venda

### Compatibilidade (rotas legadas)
- `POST /api/admin/login` - Login admin (alias)
- `GET /api/admin/` - Listar jogos (alias)
- `POST /api/client/` - Registrar cliente (alias)
- `GET|POST|PUT|DELETE /api/venda/*` - Operações de venda (alias)

## Usuário Administrador Padrão

```
Email: admin
Senha: admin
```

## Scripts NPM

```bash
npm run serve      # Inicia servidor Laravel
npm run dev        # Servidor + Vite dev
npm run migrate    # Executa migrations
npm run migrate:fresh # Recria banco com seeders
npm run seed       # Executa seeders
npm run test       # Executa testes
```

## Compatibilidade com Frontend

O backend mantém 100% de compatibilidade com o frontend Vue.js existente através de:

1. **Mesmas rotas**: As rotas foram mapeadas para manter compatibilidade
2. **Mesmo formato de resposta**: JSON responses idênticos
3. **Mesmos códigos de status**: Tratamento de erros consistente
4. **CORS configurado**: Permite requisições do frontend Vue.js

## Estrutura do Projeto

```
app/
├── Http/Controllers/
│   ├── AuthController.php     # Autenticação
│   ├── JogoController.php     # CRUD Jogos
│   └── VendaController.php    # CRUD Vendas
├── Models/
│   ├── User.php              # Usuários
│   ├── Jogo.php              # Jogos
│   └── Venda.php             # Vendas
database/
├── migrations/               # Estrutura do banco
└── seeders/                 # Dados iniciais
routes/
└── api.php                  # Rotas da API
```

## Tecnologias Utilizadas

- Laravel 11
- Laravel Sanctum (autenticação)
- MySQL/SQLite
- PHP 8.3+
- Composer
