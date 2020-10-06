<?php

namespace App\Providers;

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

        //Define Gates
        Gate::define('manageUser', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin']);
        });

        //Add Access
        Gate::define('insert', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Add']);
        });

        //Edit Access
        Gate::define('edit', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Edit']);
        });

        //Delete
        Gate::define('delete', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Delete']);
        });


        Gate::define('superuser', function ($user) {
            return $user->hasRole(['Administrator']);
        });

        Gate::define('roleManage', function ($user) {
            return $user->hasRole(['Administrator']);
        });

        Gate::define('publisher', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Publisher']);
        });

        //Post Section
        Gate::define('post', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Post-section']);
        });

        //Product-section
        Gate::define('product', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Product-section']);
        });

        //Promotion-section
        Gate::define('promotion', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Promotion-section']);
        });

        //About-section
        Gate::define('about', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'About-section']);
        });

        //About-section
        Gate::define('contact', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Contact-section']);
        });

        //Slider-section
        Gate::define('slider', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Slider-section']);
        });

        //Recomendation-section
        Gate::define('recomendation', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Recomendation-section']);
        });

        //Product-type
        Gate::define('type', function ($user) {
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Product-type']);
        });
    }
}
