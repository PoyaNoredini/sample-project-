<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'user_name' => $this->user_name,
            'profile' => $this->profile,
            'user_type' => $this->user_type,
            'phone_number' => $this->phone_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'bio' => $this->bio,
            'city' => $this->city,
            'state' => $this->state,
            // Add other user fields you want to expose
            // Note: Sensitive fields like password, tokens etc. are intentionally excluded
        ];
    }
}