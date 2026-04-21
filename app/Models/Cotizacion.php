<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [
        'user_id',
        'total_min',
        'total_max',
        'total_avg',
        'items',
        'factores',
        'comentario',
        'mensaje_confirmacion',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'factores' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
