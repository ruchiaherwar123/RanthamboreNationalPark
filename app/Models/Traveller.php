<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    use HasFactory;
    protected $table="travellers";
    protected $fillable = [
        'name',
        'fname',
        'gender',
        'age',
        'nationality',
        'id_type',
        'id_no',
        'booking_id',
     ];
}
