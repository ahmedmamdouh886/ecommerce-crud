<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'id' => $this['id'],
            'name' => $this['name'],
            'description' => $this['description'],
            'is_active' => (bool) $this['is_active'],
            'price' => $this['price'],
            'slug' => $this['slug'],
            // Assuming that business requirements state that a product will be persisted in local file system.
            'image' => asset('images/product.png'),
            'created_at' => Carbon::parse($this['created_at'])->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this['updated_at'])->format('Y-m-d H:i'),
        ];
    }
}
