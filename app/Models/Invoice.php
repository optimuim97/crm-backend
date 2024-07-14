<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($invoice) {
            $invoice->invoice_number = Str::ulid();
        });
    }


    protected $fillable = [
        "invoice_number",
        "provider_id",
        "purchase_order_id",
        "total_amount"
    ];

    public static $rules = [
        "invoice_number" => 'required',
        "purchase_order_id" => 'required',
        "provider_id" => 'required',
        "total_amount" => 'required',
    ];
}
