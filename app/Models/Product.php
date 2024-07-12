<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->internal_reference = Str::uuid();
        });
    }

    use HasFactory;
    protected $fillable = [
        "internal_reference",
        "provider_reference",
        "barcode",
        "designation",
        "price",
        "quantity"
    ];

    public static $rules = [
        "internal_reference" => "nullable",
        "provider_reference" => "nullable",
        "barcode" => "required",
        "designation" => "required",
        "price" => "nullable"
    ];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class, 'quotation_product')->withPivot('quantity');
    }
}
