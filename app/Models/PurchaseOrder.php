<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PurchaseOrder extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($purchaseOrder) {
            $purchaseOrder->order_number = Str::ulid();
        });
    }

    protected $fillable = [
        "order_number",
        "total_amount",
        "is_valided"
    ];

    public static $rules = [
        'order_number' => 'string',
        'provider_reference' => 'required|string',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        "is_valided" => "nullable",
        'total_amount' => 'required|numeric'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
