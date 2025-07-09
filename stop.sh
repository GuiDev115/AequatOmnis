#!/bin/bash
# Script para parar o projeto AequatOmnis
# Autor: GitHub Copilot

echo "🛑 Parando o projeto AequatOmnis..."
echo "====================================="

# Parar processos PHP (Laravel)
echo "🔧 Parando Backend Laravel..."
pkill -f "php artisan serve" 2>/dev/null || true
pkill -f "server.php" 2>/dev/null || true

# Parar processos Node.js (Vue.js)
echo "🎨 Parando Frontend Vue.js..."
pkill -f "vite" 2>/dev/null || true
pkill -f "npm run dev" 2>/dev/null || true

# Aguardar um pouco para garantir que os processos parem
sleep 2

# Limpar arquivos nohup
if [ -f "backend_laravel/nohup.out" ]; then
    rm backend_laravel/nohup.out
fi

if [ -f "frontend_vuejs/nohup.out" ]; then
    rm frontend_vuejs/nohup.out
fi

echo "✅ Projeto AequatOmnis parado com sucesso!"
echo "🚀 Para reiniciar, execute: ./start.sh"
