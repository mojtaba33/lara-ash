<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['image','product_id'];

    protected $casts = [
        'image' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
