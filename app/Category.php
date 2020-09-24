<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id','title','slug',
    ];

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function filters()
    {
        return $this->hasMany(Filter::class);
    }

    public function path()
    {
        return url('category/'.$this->slug);
    }

    protected $products = [];
    protected $counts = 0;

    public function getProducts()
    {
        if ( $this->parent_id != 0 )
            return $this->products()->get();

        $products = new Collection();

        foreach ($this->children()->get() as $key=>$category)
        {
            foreach ($category->products()->get() as $product)
                if ($category->products()->get()->isNotEmpty())
                    $products->push($product);
        }

        return $products;
    }


}
