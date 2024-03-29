<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    protected $table = 'salas';

    public $timestamps = false;

    protected $casts = [
        'custom' => 'array'
    ];

    protected $fillable = [
        'nome',
        'custom'
    ];

    public function screenings()
    {
        return $this->hasMany(Screening::class, 'sala_id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'sala_id');
    }
}
