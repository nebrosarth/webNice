<?php

namespace App\Providers;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('modify-object', function (User $user, Character $character)
        {
            return $user->id == $character->user_id || $user->is_admin;
        });

        $this->registerPolicies();

        if(!$this->app->routesAreCached()) {
            Passport::routes();
        }
        //
    }
}
