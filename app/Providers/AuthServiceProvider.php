<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Ability;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
            if ($user->hasAllAbilities()) {
                return true;
            }
            return false;
        });

        //Set abilities if not in console
        if (!app()->runningInConsole()) {
            $abilities = Ability::all()->except('1');
            foreach ($abilities as $ability) {
                Gate::define($ability->key, function (User $user) use($ability) {
                    return $user->hasAbility($ability->key);
                });
            }
        }
    }
}
