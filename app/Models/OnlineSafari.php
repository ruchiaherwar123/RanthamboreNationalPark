<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineSafari extends Model
{
    use HasFactory;
    protected $table="online_safaris";
    protected $fillable = [
        'booking_id',
        'select_jeep',
        'seats',
        'zone',
        'timing',
        'name',
        'mobile',
        'email',
        'date',
        'razorpay_payment_id',
        'safari_person',
        'safari_phone_no',
         'query_at',
        'remark',
        'booking_type',
        'remark_date',
     ];
}
