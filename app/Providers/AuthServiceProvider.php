<?php

namespace App\Providers;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Policies\PaymentMethodPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        PaymentMethod::class => PaymentMethodPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
