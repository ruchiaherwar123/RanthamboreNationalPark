<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table="hotelrooms";
    protected $fillable = [
        'name',
        'hotel_id',
        'room_type',
        'lunch_actual_price',
        'lunch_discount_price',
        'dinner_actual_price',
        'dinner_discount_price',
        'gstprice',
        'room_img',
     ];
}
