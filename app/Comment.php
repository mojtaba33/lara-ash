<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'rate' , 'body' ,'commentable_id',
        'commentable_type' , 'user_id' , 'parent_id' , 'approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*public function product()
    {
        return $this->belongsTo(Product::class);
    }*/

    public function child()
    {
        return $this->hasMany(Comment::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id','id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
