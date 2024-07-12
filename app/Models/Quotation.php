<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quotation extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            $quote->quote_number = Str::ulid();
        });
    }

    protected $fillable = [
        "quote_number",
        "customer_id",
        "total_amount",
        "confirmed"
    ];

    protected $rules = [
        "quote_number" => "nullable",
        "customer_id" => "nullable",
        "total_amount" => "nullable",
        "confirmed" => "nullable",
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ];

    public function produits()
    {
        return $this->belongsToMany(Product::class, 'quotation_product')->withPivot('quantity');
    }
}
