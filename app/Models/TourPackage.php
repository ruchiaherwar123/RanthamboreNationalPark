<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;
    protected $table="tour_packages";
    protected $fillable = [
        'title',
        'time',
        'jeep',
        'night_stay_time',
        'description',
        'image',
     ];
}
