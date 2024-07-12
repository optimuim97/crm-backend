<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Provider extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($provider) {
            $provider->reference = Str::uuid();
        });
    }

    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "phone_number",
        "email"
    ];

    public static $rules = [
        "name" => "required",
        "phone_number" => "nullable|unique:providers",
        "email" => "required"
    ];
}
