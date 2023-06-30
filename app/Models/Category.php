<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'slug_name'];

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function guest()
    {
        return $this->hasOne(Guest::class);
    }
}
