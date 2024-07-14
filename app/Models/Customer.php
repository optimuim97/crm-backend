<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        "first_name",
        "last_name",
        "phone_number"
    ];

    public static $rules = [
        "first_name"=> 'required',
        "last_name"=> 'required',
        "phone_number"=> 'required'
    ];
}
