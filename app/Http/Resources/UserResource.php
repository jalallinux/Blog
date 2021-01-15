<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'family' => $this->family,
            'roles' => $this->roles,
            'fullName' => $this->fullName,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'register_at' => $this->created_at->diffForHumans()
        ];
    }
}
