#!/bin/bash
# Script para iniciar o projeto AequatOmnis
# Autor: GitHub Copilot

echo "🚀 Iniciando o projeto AequatOmnis..."
echo "======================================"

# Verificar se estamos no diretório correto
if [ ! -d "backend_laravel" ] || [ ! -d "frontend_vuejs" ]; then
    echo "❌ Erro: Execute este script na raiz do projeto AequatOmnis"
    exit 1
fi

# Função para verificar se uma porta está em uso
check_port() {
    local port=$1
    if netstat -tlnp | grep -q ":$port "; then
        echo "⚠️  Porta $port já está em uso"
        return 1
    fi
    return 0
}

# Iniciar Backend (Laravel)
echo "🔧 Iniciando Backend Laravel..."
cd backend_laravel

# Verificar se o arquivo .env existe
if [ ! -f ".env" ]; then
    echo "📋 Criando arquivo .env..."
    cp .env.example .env
    php artisan key:generate
fi

# Verificar se o banco de dados existe
if [ ! -f "database/database.sqlite" ]; then
    echo "🗄️  Criando banco de dados..."
    touch database/database.sqlite
    php artisan migrate:fresh --seed
fi

# Iniciar servidor backend
if check_port 8000; then
    echo "🌐 Iniciando servidor backend na porta 8000..."
    nohup php artisan serve --host=0.0.0.0 --port=8000 > /dev/null 2>&1 &
    echo "✅ Backend iniciado: http://localhost:8000"
else
    echo "✅ Backend já está rodando na porta 8000"
fi

# Iniciar Frontend (Vue.js)
echo "🎨 Iniciando Frontend Vue.js..."
cd ../frontend_vuejs

# Instalar dependências se não existirem
if [ ! -d "node_modules" ]; then
    echo "📦 Instalando dependências do frontend..."
    npm install
fi

# Iniciar servidor frontend
if check_port 5173; then
    echo "🌐 Iniciando servidor frontend na porta 5173..."
    # Aguardar um pouco para garantir que não há processos conflitantes
    sleep 2
    nohup npm run dev > /dev/null 2>&1 &
    sleep 3
    echo "✅ Frontend iniciado: http://localhost:5173"
else
    echo "✅ Frontend já está rodando na porta 5173"
fi

echo ""
echo "🎉 Projeto AequatOmnis iniciado com sucesso!"
echo "======================================"
echo "🔗 Frontend: http://localhost:5173"
echo "🔗 Backend:  http://localhost:8000"
echo ""
echo "📚 Para acessar o admin, use as credenciais:"
echo "   Email: admin@aequatomnis.com"
echo "   Senha: password123"
echo ""
echo "📚 Ou use as credenciais simples:"
echo "   Email: admin@admin.com"
echo "   Senha: admin"
echo ""
echo "🛑 Para parar os serviços, execute: ./stop.sh"
