<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id' , 'user_id' , 'title','image','slug',
        'brand','body','color','size','price',
        'discount','count','rate','status','top_offer','sell_count',
    ];

    protected $casts = [
        'image' => 'array' ,
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
        return $this->belongsTo(Product::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class)->as('favorites')->withTimestamps();
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class)->withPivot('value');
    }

    public function path()
    {
        return url('/product/'.$this->slug);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getProductRate()
    {
        $rates = $this->comments()->where('approved',1)->where('rate','!=',0)->get()->sum('rate');
        $count = $this->comments()->where('approved',1)->where('rate',0)->get()->count();

        if ($count == 0)
            return 0;

        return round($rates/$count);
    }

    public function getProductReviewCount()
    {
        $count = $this->comments()->where('approved',1)->where('rate',0)->get()->count();
        return $count;
    }

    /**
     * @param String $size
     * @return bool
     */
    public function hasSize(String $size)
    {
        if($this->where('id',$this->id)->where('size','LIKE',"%'".$size."'%")->first())
            return true;

        return false;
    }

    public function scopeSearch($query)
    {
        if (request('item') != null)
        {
            $query->where('title','like','%'. request('item') .'%');
        }

        return $query;
    }

    public function scopeFilter($query)
    {
        if (\request()->input('maxPrice') != null)
        {
            $maxPrice = (int) explode('$', \request()->input('maxPrice'))[1];
            $query->where('price', '<=', $maxPrice);
        }

        if (\request()->input('minPrice') != null)
        {
            $minPrice = (int) explode('$', \request()->input('minPrice'))[1];
            $query->where('price', '>=', $minPrice);
        }

        $sizes = ['xxs','xs','xss','s','m','ml','l','xl'];
        foreach ($sizes as $size)
        {
            if (\request()->has($size)) {
                $query->where('size','LIKE',"%'".$size."'%");
            }
        }

        if (request('item') != null)
        {
            $query->where('title','like','%'. request('item') .'%');
        }
        return $query;
    }

    public function getPrice()
    {
        return  $this->discount == 0 ?
                $this->price :
                $this->price - ( $this->price * $this->discount ) / 100;
    }

}
