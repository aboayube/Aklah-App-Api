<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => asset('Laravel/public/assets/users' . $this->wasfa->image),
            'name' => $this->wasfa->name(),
            'chef_name' => $this->wasfa->user->name,
            'chef_image' => $this->wasfa->user->image,
        ];;
    }
}
