<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'empresa',
        'genero',
        'plataforma',
        'valor',
        'estoque',
        'featured_image',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'estoque' => 'boolean',
        'valor' => 'decimal:2'
    ];
}
