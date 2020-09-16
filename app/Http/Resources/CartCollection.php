<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item){
            return [
                'cart_id'       => $item->id,
                'count'         => $item->count,
                'price'         => $item->product->getPrice() * $item->count,
                'color'         => $item->color,
                'size'          => $item->size,
                'title'         => $item->product->title,
                'image'         => url($item->product->image[90]),
                'product_id'    => $item->product_id,
                'product_price' => $item->product->getPrice(),
                'url'           => $item->product->path(),
            ];
        });
    }
}
