<?php

namespace App\Http\Resources\Profile;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'name' => $this->name,
            'user' => $this->user->name,
        ];
    }
}
