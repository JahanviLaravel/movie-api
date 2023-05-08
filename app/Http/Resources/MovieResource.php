<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      return [
          'id' => $this->id,
          'name' => $this->name,
          'description' => $this->description,
          'image' => $this->image,
          'release_date' => $this->release_date,
          'rating' => $this->rating,
          'award_winning' => $this->award_winning,
          'genres' => $this->genre,
          'actors' => $this->actor,
      ];
    }
}
