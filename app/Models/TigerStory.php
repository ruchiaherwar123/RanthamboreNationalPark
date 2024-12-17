<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TigerStory extends Model
{
    use HasFactory;
    protected $table="tiger_stories";
    protected $fillable = [
        'title',
        'image',
        'description',
     ];
}
