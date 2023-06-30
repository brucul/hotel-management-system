<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'name', 'slug_name', 'number', 'location', 'is_booked', 'price', 'pict'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function room_acomodation()
    {
        return $this->hasMany(RoomAcomodation::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
