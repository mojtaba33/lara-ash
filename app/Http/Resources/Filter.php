<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Filter extends JsonResource
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
            'filter_id' => $this->id,
            'title' => $this->title,
            'parent_id' => $this->parent_id,
            'parent' => isset($this->parent()->first()->title) ? $this->parent()->first()->title :  'سرگروه' ,

        ];
    }
}
