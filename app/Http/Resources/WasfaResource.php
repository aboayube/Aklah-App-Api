<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WasfaResource extends JsonResource
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
            'name' => $this->name(),
            'price' => $this->price,
            'discription' => $this->discription(),
            'image' =>  asset('Laravel/public/assets/wasfas/' . $this->image),
            'time_make' => $this->time_make,
            'number_user' => $this->number_user,
            'wasfa_contents' =>   WasfaContentResource::collection($this->wasfa_content),

        ];
    }
}
