<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table="hotels";
    protected $fillable = [
        'name',
        'image',
        'description',
        'facilities',
        'location',
        'price',
        'price2',
        'price3',
        'rating',
     ];
}
