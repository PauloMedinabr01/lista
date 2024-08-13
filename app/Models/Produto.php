<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'quantidade',
        'preco_unitario',
        'lista_id',
    ];

    public function lista(): BelongsTo
    {
        return $this->belongsTo(Lista::class);
    }
}
