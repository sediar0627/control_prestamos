<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'nombre',
        'folios',
    ];

    public function prestamo(): HasOne
    {
        return $this->hasOne(Prestamo::class, 'expediente_id');
    }
}
