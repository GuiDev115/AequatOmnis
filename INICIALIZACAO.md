# 🚀 Guia de Inicialização - AequatOmnis

Este projeto foi configurado com sucesso! Aqui está um resumo completo de como iniciar e usar o sistema.

## ✅ Status Atual
- ✅ Backend Laravel configurado e rodando na porta 8000
- ✅ Frontend Vue.js configurado e rodando na porta 5173
- ✅ Banco de dados SQLite criado e populado com dados iniciais
- ✅ Usuário administrador criado
- ✅ Problemas de importação de componentes corrigidos
- ✅ Todos os componentes Vue.js funcionando corretamente

## 🌐 URLs de Acesso

### Frontend (Vue.js)
- **URL**: http://localhost:5173
- **Tecnologia**: Vue.js 3 + Vuetify 3.3
- **Funcionalidades**: Interface do usuário, carrinho, catálogo de jogos

### Backend (Laravel)
- **URL**: http://localhost:8000
- **Tecnologia**: Laravel 12 + PHP 8.2
- **Funcionalidades**: API REST, autenticação, gerenciamento de dados

## 🔐 Credenciais de Acesso

### Administrador Principal
- **Email**: admin@aequatomnis.com
- **Senha**: password123

### Administrador Simples
- **Email**: admin@admin.com
- **Senha**: admin

## 📁 Estrutura do Projeto

```
AequatOmnis/
├── backend_laravel/          # Backend Laravel
│   ├── app/
│   │   ├── Http/Controllers/ # Controladores da API
│   │   └── Models/           # Modelos (User, Jogo, Venda)
│   ├── database/
│   │   ├── migrations/       # Migrações do banco
│   │   ├── seeders/         # Dados iniciais
│   │   └── database.sqlite  # Banco de dados
│   └── routes/api.php       # Rotas da API
│
├── frontend_vuejs/          # Frontend Vue.js
│   ├── src/
│   │   ├── components/      # Componentes Vue
│   │   ├── views/          # Páginas da aplicação
│   │   └── router/         # Roteamento
│   └── package.json        # Dependências do frontend
│
├── start.sh                 # Script para iniciar o projeto
├── stop.sh                  # Script para parar o projeto
└── README.md               # Documentação principal
```

## 🔄 Comandos Úteis

### Para iniciar o projeto
```bash
./start.sh
```

### Para parar o projeto
```bash
./stop.sh
```

### Para verificar se está rodando
```bash
# Verificar processos
ps aux | grep -E "(php|node)" | grep -v grep

# Verificar portas
netstat -tlnp | grep -E ":(8000|5173)"
```

## 🛠 Funcionalidades Implementadas

### Backend (Laravel)
- ✅ Autenticação JWT com Laravel Sanctum
- ✅ CRUD de Jogos (título, descrição, empresa, gênero, plataforma, valor, estoque)
- ✅ CRUD de Vendas (nome_produto, comprador, email, total)
- ✅ Gestão de Usuários com perfil administrador
- ✅ Migrações e seeders configurados
- ✅ CORS configurado para o frontend

### Frontend (Vue.js)
- ✅ Interface com Vuetify
- ✅ Roteamento configurado
- ✅ Componentes modulares
- ✅ Integração com API backend
- ✅ Design responsivo

## 🔧 Tecnologias Utilizadas

### Backend
- PHP 8.2+
- Laravel 12
- SQLite
- Laravel Sanctum (Autenticação)
- Composer

### Frontend
- Vue.js 3
- Vuetify 3.3
- Vue Router
- Axios
- Vite
- Node.js/NPM

## 🚨 Troubleshooting

### Se o backend não iniciar:
```bash
cd backend_laravel
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### Se o frontend não iniciar:
```bash
cd frontend_vuejs
npm install
npm run dev
```

### Se houver erros de importação de componentes:
Os arquivos de componentes são sensíveis a maiúsculas/minúsculas:
- `NavBar.vue` (correto)
- `Navbar.vue` (incorreto)

### Se as portas estiverem ocupadas:
```bash
# Matar processos
pkill -f "php artisan serve"
pkill -f "vite"
pkill -f "npm run dev"
```

### Problemas comuns corrigidos:
- ✅ Importação incorreta de `Navbar.vue` → `NavBar.vue`
- ✅ Componente `Cards` não importado em views
- ✅ Inconsistências entre nomes de importação e uso no template

## 📝 Próximos Passos

1. **Testar o sistema**: Acesse http://localhost:5173 e teste as funcionalidades
2. **Login como admin**: Use as credenciais fornecidas para acessar a área administrativa
3. **Desenvolver**: Continue desenvolvendo as funcionalidades conforme a documentação
4. **Deploy**: Quando pronto, configure para produção

## 📞 Suporte

Para problemas ou dúvidas:
1. Verifique os logs em `backend_laravel/storage/logs/`
2. Consulte a documentação do Laravel e Vue.js
3. Verifique se todas as dependências estão instaladas

---

**Projeto iniciado com sucesso!** 🎉
