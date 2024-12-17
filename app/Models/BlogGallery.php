<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogGallery extends Model
{
    use HasFactory;
	protected $table="blog_galleries";
    protected $fillable = [
        'blog_image',
        'alt_text',
     ];
}
