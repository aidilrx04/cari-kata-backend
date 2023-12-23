<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'words' => $this->words,
            'grid' => new GridResource($this->grid),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
