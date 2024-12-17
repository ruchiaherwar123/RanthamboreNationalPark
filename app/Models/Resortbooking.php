<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resortbooking extends Model
{
    use HasFactory;
    protected $table="resortbookings";
    protected $fillable = [
        'hotel',
        'gate',
        'persons',
        'checkindate',
        'rooms',
        'name',
        'email',
        'mobile',
        'city',
        'country',
        'priceresort',
        'payment_id',
         'query_at',
        'remark',
        'remark_date',
     ];
}
