<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Livewire\RecyclingCenter;
use App\Policies\RecyclingCenterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        RecyclingCenter::class => RecyclingCenterPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    
}
