<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'user_id','payment','count','price','resnumber','address','name','lastName','phone','postCode','deliver'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function succussfulPayment()
    {
        return $this->where('payment',1)->where('resnumber','!=',null)->get();
    }

    public function UnsuccessfulPayment()
    {
        return $this->where('payment',0)->where('resnumber','!=',null)->get();
    }

}
