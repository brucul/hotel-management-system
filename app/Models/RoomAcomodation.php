<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAcomodation extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'name', 'slug_name'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
