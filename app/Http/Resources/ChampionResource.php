<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChampionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {   
        
        return [

                /*
                'id' => $this->id,
                'name' => $this->name,
                'difficulty' => $this->difficulty,
                */
                //'Users' => new UserResource($this->whenLoaded('Users')),
                //'comments' => $this -> comments,
                'comments' => new ChampionResource($this->whenLoaded('comments')),
            
        ];
        
    }
}
