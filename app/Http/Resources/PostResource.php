<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'caption' => $this->caption,
            'body' => $this->body,
            'cover' => $this->cover,
            'category' => $this->category->name,
            'user' => new UserResource($this->user),
            'comment_count' => $this->comments()->count(),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
