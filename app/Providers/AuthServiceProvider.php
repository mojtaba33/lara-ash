<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (Permission::all() as $permission){
            Gate::define( $permission->title ,function () use($permission){
                return auth()->user()->hasRoleGate($permission->roles()->pluck('title'));
            });
        }

        Gate::define('edit-own-product',function($user , $product){
            return $user->id === $product->user_id || $user->hasRoleGate('Senior-administrator');
        });
    }
}
