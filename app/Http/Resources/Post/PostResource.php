<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Tag\TagCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'title' => $this->title,
            'code' => $this->code,
            'detail_text' => $this->detail_text,
            'published' => $this->published,
            'tags' => new TagCollection($this->tags)
        ];
    }
}
