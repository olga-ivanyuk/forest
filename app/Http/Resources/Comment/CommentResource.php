<?php

namespace App\Http\Resources\Comment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'created_at' => $this->formatted_at,
            'content' => $this->content,
            'profile' => $this->profile->name,
            'post' => $this->post->title,
            'is_liked' => $this->is_liked,
            'liked_profiles_count' => $this->liked_profiles_count,
        ];
    }
}
