<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpKernel\HttpClientKernel;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites()
    {
        return $this->belongsToMany(Product::class)->as('favorites')->withTimestamps();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        foreach ($this->roles()->get() as $userRoles) {
            if ($role->id == $userRoles->id){
                return true;
            }
        }
        return false;
    }

    public function hasRoleGate($roles)
    {
        if(is_string($roles)){
            return $this->roles->contains('title',$roles);
        }
        else{
            foreach ($roles as $role){
                return $this->hasRoleGate($role);
            }
        }
        return false;
    }
}
