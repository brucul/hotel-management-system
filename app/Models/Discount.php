<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'name', 'slug_name'];

    public function room()
    {
        return $this->hasOne(Reservation::class);
    }
}
