<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $table = 'sessoes';

    protected $fillable = [
        'filme_id',
        'sala_id',
        'data',
        'horario_inicio',
        'custom'
    ];

    protected $dates = [
        'data' => 'Y-m-d',
        'horario_inicio' => 'H:i:s'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'filme_id');
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class, 'sala_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'sessao_id');
    }
}
