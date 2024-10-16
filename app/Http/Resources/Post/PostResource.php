<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Profile\ProfileResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'formatted_at' => $this->formatted_at,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'image_url' => $this->image_url,
            'views' =>  $this->views,
            'status' =>  $this->status,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'category' => $this->category->title,
//            'profile' => $this->profile->name,
//            'category' => $this->category->title,
//            'user' => $this->profile->user->name,
        ];
    }
}
