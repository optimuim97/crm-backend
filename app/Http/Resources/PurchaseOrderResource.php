<?php

namespace App\Http\Resources;

use App\Models\Invoice;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_number' => $this->order_number,
            'provider_id' => $this->provider_id,
            'total_amount' => $this->total_amount,
            'is_valided' => $this->is_valided,
            'created_at' => $this->created_at,
            'name' => Provider::find($this->provider_id)->name ?? '-',
            'phone_number' => Provider::find($this->provider_id)->phone_number ?? '-',
            'email' => Provider::find($this->provider_id)->email ?? '-',
            'invoice' => Invoice::where(['purchase_order_id' => $this->id])->first()
        ];
    }
}
