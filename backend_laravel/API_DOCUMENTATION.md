# Documentação da API - AequatOmnis Backend Laravel

## URL Base
```
http://localhost:8000/api
```

## Autenticação

Todas as rotas protegidas requerem o header:
```
Authorization: Bearer {token}
```

### 1. Register
```http
POST /api/register
Content-Type: application/json

{
    "name": "João Silva",
    "email": "joao@email.com",
    "password": "123456",
    "administrador": false
}
```

**Response (201):**
```json
{
    "user": {
        "id": 1,
        "name": "João Silva",
        "email": "joao@email.com",
        "administrador": false
    },
    "token": "1|abc123...",
    "token_type": "Bearer"
}
```

### 2. Login
```http
POST /api/login
Content-Type: application/json

{
    "email": "admin",
    "password": "admin"
}
```

**Response (200):**
```json
{
    "user": {
        "id": 1,
        "name": "admin",
        "email": "admin",
        "administrador": true
    },
    "token": "2|def456...",
    "token_type": "Bearer",
    "tokenExpiration": "1d"
}
```

## Jogos

### 1. Listar Jogos
```http
GET /api/jogos
```

**Response (200):**
```json
[
    {
        "id": 1,
        "titulo": "The Witcher 3",
        "descricao": "RPG de mundo aberto",
        "empresa": "CD Projekt Red",
        "genero": "RPG",
        "plataforma": "PC, PS4, Xbox",
        "valor": "49.99",
        "estoque": true,
        "featured_image": "images/witcher3.jpg",
        "images": ["img1.jpg", "img2.jpg"],
        "created_at": "2025-07-08T13:40:22.000000Z",
        "updated_at": "2025-07-08T13:40:22.000000Z"
    }
]
```

### 2. Criar Jogo
```http
POST /api/jogos
Content-Type: application/json

{
    "titulo": "Cyberpunk 2077",
    "descricao": "Jogo de RPG futurístico",
    "empresa": "CD Projekt Red",
    "genero": "RPG",
    "plataforma": "PC, PS5, Xbox Series",
    "valor": 199.99,
    "estoque": true
}
```

### 3. Upload de Imagem
```http
POST /api/jogos/1/featured-image
Content-Type: multipart/form-data

featuredImage: [arquivo_imagem.jpg]
```

**Response (200):**
```json
{
    "message": "Imagem carregada com sucesso",
    "featured_image": "images/abc123.jpg"
}
```

### 4. Atualizar Jogo
```http
PUT /api/jogos/1
Content-Type: application/json

{
    "valor": 149.99,
    "estoque": false
}
```

### 5. Deletar Jogo
```http
DELETE /api/jogos/1
```

**Response (200):**
```json
{
    "message": "Jogo removido com sucesso"
}
```

## Vendas

### 1. Listar Vendas
```http
GET /api/vendas
```

### 2. Criar Venda
```http
POST /api/vendas
Content-Type: application/json

{
    "nome_produto": "The Witcher 3",
    "comprador": "João Silva",
    "email": "joao@email.com",
    "total": 49.99
}
```

**Response (201):**
```json
{
    "id": 1,
    "nome_produto": "The Witcher 3",
    "comprador": "João Silva",
    "email": "joao@email.com",
    "total": "49.99",
    "created_at": "2025-07-08T13:40:22.000000Z",
    "updated_at": "2025-07-08T13:40:22.000000Z"
}
```

## Rotas de Compatibilidade

### Admin (mesmo que auth)
```http
POST /api/admin/login    # = POST /api/login
GET /api/admin/          # = GET /api/jogos
```

### Client (mesmo que register)
```http
POST /api/client/        # = POST /api/register
```

### Venda (aliases)
```http
GET /api/venda/          # = GET /api/vendas
POST /api/venda/         # = POST /api/vendas
GET /api/venda/1         # = GET /api/vendas/1
PUT /api/venda/1         # = PUT /api/vendas/1
DELETE /api/venda/1      # = DELETE /api/vendas/1
```

## Códigos de Status

- **200**: Sucesso
- **201**: Criado com sucesso
- **400**: Erro de validação/dados
- **401**: Não autenticado
- **403**: Não autorizado (admin necessário)
- **404**: Recurso não encontrado
- **500**: Erro interno do servidor

## Exemplos de Erro

**Erro de Validação (400):**
```json
{
    "error": "Não foi possível salvar o jogo. Verifique os dados e tente novamente"
}
```

**Não Autenticado (401):**
```json
{
    "error": "Credenciais inválidas"
}
```

**Acesso Negado (403):**
```json
{
    "error": "Acesso negado. Apenas administradores podem acessar este recurso."
}
```
