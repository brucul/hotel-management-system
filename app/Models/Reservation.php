<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id', 'room_id', 'type_id', 'guest_in_house', 'bed', 'check_in', 'check_out', 'adult', 'children', 'additional_info', 'discount_id', 'agency'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}
