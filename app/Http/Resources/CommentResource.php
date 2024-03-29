<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'user_name' => $this->user->name,
            'card_id' => $this->card->id,
            'card_name' => $this->card->name,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
