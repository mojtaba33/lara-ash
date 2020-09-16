<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FilterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function($value){
            return [
                'filter_id' => $value->id,
                'title' => $value->title,
                'parent_id' => $value->parent_id,
                'parent' => isset($value->parent()->first()->title) ? $value->parent()->first()->title :  'سرگروه' ,
            ];
        });
    }
}
