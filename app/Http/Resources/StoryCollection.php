<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'story' => $this->story,
            'date' => (new Carbon($this->created_at))->format('d F Y H:i'),
            'likes' => $this->likes->count(),
            'visitorLikes' => $this->visitorLikesIt(),
        ];
    }
}
