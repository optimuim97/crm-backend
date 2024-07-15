<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Transaction extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($transaction) {
            $transaction->reference_transaction = Str::ulid();
        });
    }

    protected $fillable = [
        "invoice_id",
        "payment_method_id",
        "amount",
        "fee",
        "total_amount",
        "status",
        "reference_operateur",
        "memo",
        "reference_transaction"
    ];

    public static $rules = [
        "invoice_id" => "required",
        "payment_method_id" => "required",
        "amount" => "required|nullable",
        "fee" => "nullable",
        "total_amount" => "required|nullable",
        "status" => "required",
        "reference_operateur" => "nullable",
        "memo" => "nullable",
        "reference_transaction" => "nullable"
    ];
}
