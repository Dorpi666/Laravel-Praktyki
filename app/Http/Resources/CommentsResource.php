<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'text' => $this->body,
            'replies' => CommentsResource::collection($this ->replies),
            //'comment' => new CommentsResource($this->whenLoaded('comment')),

        ];
    }
}
