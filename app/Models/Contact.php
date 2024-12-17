<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Mail;
// use App\Mail\ContactUsMail;


class Contact extends Model
{
    use HasFactory;
    protected $table="contact";
    protected $fillable = [
        'name',
        'subject',
        'email',
        'mobile',
        'message',
        'query_at',
        'remark',
        'remark_date',
     ];

    //  public static function boot() {
  
    //     parent::boot();
  
    //     static::created(function ($item) {
                
    //         $adminEmail = "ruchiaherwar25@gmail.com";
    //         Mail::to($adminEmail)->send(new ContactUsMail($item));
    //     });
    // }
}
