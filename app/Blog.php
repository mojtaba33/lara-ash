<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','category_id','title','image','slug','body','tags',
    ];

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function path()
    {
        return url('/blog/'.$this->slug);
    }

    /*public function scopeTags($query,$tag)
    {
        $query->where('tags','like',$tag)
    }*/
}
