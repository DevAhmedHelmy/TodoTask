<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'name' => $this->name,
            'todo_id' => $this->todo_id,
            'todo_name' => $this->todo->name,
            'todoId' => $this->todo->id,
            'cards' => CardResource::collection($this->cards),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
