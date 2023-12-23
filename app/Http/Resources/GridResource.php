<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GridResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'rows' => $this->rows,
            'columns' => $this->columns,
            'grid' => $this->grid,
            'solved' => $this->solved,
        ];
    }
}
