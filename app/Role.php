<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'title' , 'fa_title',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        foreach ($this->permissions()->get() as $value) {
            if ($value->id == $permission->id){
                return true;
            }
        }
        return false;
    }
}
