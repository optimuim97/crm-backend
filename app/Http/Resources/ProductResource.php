<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'internal_reference' => $this->internal_reference,
            'barcode' => $this->barcode,
            'designation' => $this->designation,
            'price' => $this->price,
            'purchase_order_id' => $this->pivot->purchase_order_id,
            'product_id' => $this->pivot->product_id,
            'quantity' => $this->pivot->quantity,
            'created_at' => $this->pivot->created_at
        ];
    }
}
