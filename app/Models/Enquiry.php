<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Mail;
// use App\Mail\ContactMail;

class Enquiry extends Model
{
    use HasFactory;
    protected $table="enquiries";
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'country',
        'message',
        'query_at',
        'follow_up_remark',
        'remark_date',
     ];
}
