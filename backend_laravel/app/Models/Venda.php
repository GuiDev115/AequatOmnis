<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_produto',
        'comprador',
        'email',
        'total'
    ];

    protected $casts = [
        'total' => 'decimal:2'
    ];
}
