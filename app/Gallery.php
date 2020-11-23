<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['image','product_id'];

    protected $casts = [
        'image' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
