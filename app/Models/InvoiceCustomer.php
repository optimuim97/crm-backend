<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceCustomer extends Model
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
        "customer_id",
        "is_paid",
        "quotation_id",
        "fee",
        "amount",
        "total_amount",
    ];

    public static $rules = [
        "fee" => 'nullable',
        "quotation_id" => 'required',
        "customer_id" => 'required',
        "amount" => 'required',
        "total_amount" => 'required',
    ];

    /**
     * Get the quotation that owns the InvoiceCustomer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
