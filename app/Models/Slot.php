<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'start', 'end'];

    // $casts serve per la conversione dei dati
    protected $casts = [
        'start' => 'datetime:H:i',
        'end' => 'datetime:H:i'
    ];
}
