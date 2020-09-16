<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'rate' , 'body' , 'product_id' , 'user_id' , 'parent_id' , 'approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function child()
    {
        return $this->hasMany(Comment::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id','id');
    }
}
