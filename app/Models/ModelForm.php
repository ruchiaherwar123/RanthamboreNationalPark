<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelForm extends Model
{
    use HasFactory;
    protected $table="model_forms";
    protected $fillable = [
        'name',
        'date',
        'tel',
        'remark',
        'query_at',
        'follow_up_remark',
        'follow_up_remark_date',
     ];
}
