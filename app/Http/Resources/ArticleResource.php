<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            "id" => (string)$this->id,
            "image" => $this->image,
            "title" => $this->title,
            "stock" => $this->stock,
            "active" => (boolean)$this->active,
            "text" => $this->text,
            "category" => [
                'id' => $this->category->id,
                'title' => $this->category->title,
                'active' => $this->category->active,
            ],
            "tags" => $this->tags,
            "views" => $this->views,
            "likes" => $this->likes,
            "dislikes" => $this->dislikes,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),

        ];
    }
}
