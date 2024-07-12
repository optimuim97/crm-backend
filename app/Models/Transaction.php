<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "amount",
        "fee",
        "total_amount",
        "status",
        "reference_operateur",
        "memo",
        "reference_transaction"
    ];
}
