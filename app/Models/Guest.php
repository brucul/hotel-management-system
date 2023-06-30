<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'nik', 'name', 'slug_name', 'email', 'phone', 'address', 'city', 'country', 'additional_info'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
