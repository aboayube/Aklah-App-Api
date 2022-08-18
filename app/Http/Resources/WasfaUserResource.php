<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WasfaUserResource extends JsonResource
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
            'id' => $this->wasfa->id,
            'image' =>  asset('Laravel/public/assets/wasfas_content/' . $this->wasfa->image),
            'name' => $this->wasfa->name(),
            'price' => $this->price,
            'user_name' => $this->wasfa->user->name,
            'chef_name' => $this->wasfa->user->name,
            'countity' => $this->countity,
            'status' => $this->status,
            'wasfa_content' => WasfaContentResource::collection($this->wasfa->wasfa_content),
        ];
    }
}
