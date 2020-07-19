<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OffreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
  
    public function toArray($request)
    {
        //transforms the resource into an array made up of the attributes to be converted to JSON
        return [
            'id'=> $this->id,
            'titre'=> $this->titre,
            'description'=>$this->description,
            //'prix' => $this->prix,
            //'superficie' => $this->superficie,
            'capacite' => $this->capacite,
            'user_id'=>$this->user_id,
            'image' =>$this->image,
            'latitude' =>$this->latitude,
            'longitude' =>$this->longitude,
            'tel' =>$this->tel,
            'adresse'=>$this->adresse

           
        ];

    }
}
