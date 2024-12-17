<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceSafari extends Model
{
    use HasFactory;
    protected $table="price_safaris";
    protected $fillable = [
        'price',
        'day',
        'sharing_price',
        'nationality',
     ];
}
