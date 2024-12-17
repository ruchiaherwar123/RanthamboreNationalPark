<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table="news";
    protected $fillable = [
        'date',
        'title',
        'description',
        'image',
        'alt',
        'seo_name',
        'meta_title',
        'meta_keywords',
        'meta_description',
     ];
}
