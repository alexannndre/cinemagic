<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'lugares';

    public $timestamps = false;

    protected $fillable = [
        'sala_id',
        'fila',
        'posicao',
        'custom'
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class, 'sala_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'lugar_id');
    }

    public function isOccupied($screening_id)
    {
        return $this->tickets()->where('sessao_id', $screening_id)->count() > 0;
    }

    public function isInCart($seat_id)
    {
        $cart = session('cart');
        if (isset($cart))
            foreach ($cart as $item)
                if ($item['seat']->id === $seat_id)
                    return true;
        return false;
    }
}
