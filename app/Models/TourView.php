<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourView extends Model
{
    use HasFactory;
    protected $table="tour_views";
    protected $fillable = [
        'day',
        'title',
        'description',
        'image',
        'what_for',
     ];
}
