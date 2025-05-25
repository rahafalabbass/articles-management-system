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
            'id'         => $this->id,
            'title'      => $this->title,
            'content'    => $this->content,
            'created_at' => $this->created_at->toDateTimeString(),

            'images'     => $this->images->map(function ($image) {
                return [
                    'id'  => $image->id,
                    'url' => asset($image->url), 
                ];
            }),
        ];
        
    }
}
