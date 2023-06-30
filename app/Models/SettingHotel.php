<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingHotel extends Model
{
    use HasFactory;

    protected $fillable = [
    	'hotel_name', 
    	'app_name', 
    	'address', 
    	'regency', 
    	'province', 
    	'phone', 
    	'number_fax', 
    	'email', 
    	'website', 
    	'pict', 
        'bed',
    	'breakfast',
    ];
}
