<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "quote_number" => $this->quote_number,
            "customer_id" => $this->customer_id,
            "invoice" => $this->invoice,
            "customer_fullname" => Customer::find($this->customer_id)->first()->first_name . " " . Customer::find($this->customer_id)->first()->last_name,
            "total_amount" => $this->total_amount,
            "confirmed" => $this->confirmed,
            "products" => $this->products,
            "created_at" => $this->created_at
        ];
    }
}
