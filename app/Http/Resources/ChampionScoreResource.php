<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CharacterScore;
use App\Models\User;
use App\Models\Character;
use App\Http\Resources\UserResource;
use App\Http\Resources\ChampionResource;

class ChampionScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
    
        return [
            

           
            'character' => new ChampionResource($this->whenLoaded('character')),
            'user' =>  new UserResource($this->whenLoaded('user')),
            'Score' => $this-> Score,
            
        ];
        
    }
}
