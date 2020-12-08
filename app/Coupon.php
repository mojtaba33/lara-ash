<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'code', 'value', 'expired_at'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_used');
    }

    public function hasCategory(Category $category)
    {
        foreach ($this->categories as $item)
        {
            if ($item->id == $category->id)
            {
                return true;
            }
        }

        return false;
    }

    public function is_expired()
    {
        if ($this->expired_at < Carbon::now())
        {
            return true;
        }

        return false;
    }
}
