<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotelbooking extends Model
{
    use HasFactory;
    protected $table="hotelbooking";
    protected $fillable = [
        'hotel',
        'persons',
        'checkindate',
        'rooms',
        'name',
        'email',
        'mobile',
        'city',
        'country',
        'price',
        'payment_id',
         'query_at',
        'remark',
        'remark_date',
     ];
}
