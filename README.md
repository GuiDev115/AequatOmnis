# <p align="center">Aequat Omnis cinis</p>

Aequat Omnis cinis é um sistema de compra de chaves de jogos que podem ser utilizados em outras plataformas, permitindo que os clientes tenham acesso a uma gama de jogos a disposição em um único lugar, facilitando assim a busca e obtenção destes produtos de uma maneira prática e acessível.<br>
O sistema preve e implementa funcionalidades para 3 possiveis usuários: Usuário, Cliente, Administrador.<br>

<div align="center">
  <p>
    <img alt="GitHub top language" src="https://img.shields.io/github/languages/top/zSchwi/AequatOmnis?color=39C2D8&logoColor=39C2D8&style=for-the-badge">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/zSchwi/AequatOmnis?color=39C2D8&logoColor=39C2D8&style=for-the-badge">
  </p>
</div>

## 🚀 Como iniciar o projeto

### Pré-requisitos
- PHP 8.2 ou superior
- Composer 2.0 ou superior
- Node.js 18.16 ou superior
- NPM ou Yarn

### Método 1: Usando scripts automatizados (Recomendado)

```bash
# Clone o repositório
git clone <url-do-repositorio>
cd AequatOmnis

# Execute o script de inicialização
./start.sh

# Para parar o projeto
./stop.sh
```

### Método 2: Inicialização manual

#### Backend (Laravel)
```bash
# Entre na pasta do backend
cd backend_laravel

# Instale as dependências PHP
composer install

# Instale as dependências Node.js (para assets)
npm install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Crie o banco de dados
touch database/database.sqlite
php artisan migrate:fresh --seed

# Inicie o servidor
php artisan serve --host=0.0.0.0 --port=8000
```

#### Frontend (Vue.js)
```bash
# Em outro terminal, entre na pasta do frontend
cd frontend_vuejs

# Instale as dependências
npm install

# Inicie o servidor de desenvolvimento
npm run dev
```

### 🌐 Acessando o sistema

- **Frontend**: http://localhost:5173
- **Backend API**: http://localhost:8000

### 🔐 Credenciais de administrador

- **Email**: admin@aequatomnis.com
- **Senha**: password123

## 🖥 Principais Funcionalidades:
- Login (Cliente/ADM) RF
- Cadastro (Cliente/ADM) RF
- Gerenciar perfil de usuário RF
   - Cadastrar
   - Atualizar 
   - Excluir 
   - Visualizar
- Gerenciar Produto RF
   - Cadastrar
   - Atualizar 
   - Excluir 
   - Visualizar
- Gerenciar Vendas RF
   - Cadastra
   - Atualiza
   - Visualiza
   - Exclui
- Gerenciar Carrinho RF
   - Visualizar produtos adicionados
   - Excluir produtos
   - Alterar quantidade

## 👨🏾‍🦱 Usuários e entidades do sistema:
#### Usuários:
- Usuário(não logado/cadastrado)
- Cliente
- Administrador
#### Entidades:
- Cliente
- Produto
- Venda

## 🔧 Tecnologias utilizadas:
1. FrontEnd:
```
   ◉ VueJs 3
   ◉ Vuetify 3.3 (Icarus)
   ◉ HTML 5
   ◉ CSS 3
   ◉ JavaScript
```
2. BackEnd:
 ```
   ◉ Laravel 12
   ◉ PHP 8.2+
   ◉ Laravel Sanctum (Autenticação)
   ◉ SQLite (Banco de dados)
   ◉ Vite (Build tools)
```

## 📁 Estrutura do projeto
```
AequatOmnis/
├── backend_laravel/          # Backend Laravel
│   ├── app/                  # Código da aplicação
│   ├── database/             # Migrações e seeders
│   ├── routes/               # Rotas da API
│   └── ...
├── frontend_vuejs/           # Frontend Vue.js
│   ├── src/                  # Código fonte
│   ├── components/           # Componentes Vue
│   ├── views/                # Páginas da aplicação
│   └── ...
├── Documentação/             # Documentação do projeto
├── start.sh                  # Script para iniciar o projeto
├── stop.sh                   # Script para parar o projeto
└── README.md                 # Este arquivo
```

## 🛠 Comandos úteis

### Backend Laravel
```bash
# Executar migrações
php artisan migrate

# Executar seeders
php artisan db:seed

# Limpar cache
php artisan cache:clear

# Executar testes
php artisan test
```

### Frontend Vue.js
```bash
# Instalar dependências
npm install

# Executar em desenvolvimento
npm run dev

# Build para produção
npm run build

# Preview da build
npm run preview
```

## 🔍 Troubleshooting

### Erro: "Database file does not exist"
```bash
# Criar arquivo do banco de dados
touch backend_laravel/database/database.sqlite
```

### Erro: "Port already in use"
```bash
# Verificar processos nas portas
netstat -tlnp | grep -E ":(8000|5173)"

# Matar processos se necessário
pkill -f "php artisan serve"
pkill -f "vite"
```

### Erro: "Application key not set"
```bash
# Gerar nova chave
cd backend_laravel
php artisan key:generate
```
