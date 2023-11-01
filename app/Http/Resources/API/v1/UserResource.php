<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
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
            'user_name' => $this['username'],
            'is_active' => (bool) $this['is_active'],
            'type' => $this['type'],
            // Assuming that business requirements state that a user will be persisted in local file system.
            'image' => asset('images/avatar.png'),
            'created_at' => Carbon::parse($this['created_at'])->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this['updated_at'])->format('Y-m-d H:i'),
        ];
    }
}
