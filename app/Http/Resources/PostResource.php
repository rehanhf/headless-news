<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        #return explicit array, hiding raw db structure
        return [
            'id' => $this->id,
            'headline' => $this->title,
            'slug' => $this->slug,
            'summary' => str($this->content)->limit(50),
            'published_at' => $this->created_at->format('Y-m-d H:i'),
            #return relationship data if loaded
            'author' => $this->whenLoaded('author', function () {
                return $this->author->name;
            }),
            'category' => $this->whenLoaded('category', function () {
                return $this->category->name;
            }),
            'tags' => $this->whenLoaded('tags', function () {
                return $this->tags->pluck('name');
            }),
        ];
    }
}
