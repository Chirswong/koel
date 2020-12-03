<?php

namespace App\Providers;

use App\Models\User;
use App\Service\TokenManager;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

        Auth::viaRequest('token-via-query-parameter', static function ($request): ?User {
            $tokenManager = app(TokenManager::class);

            return $tokenManager->getUserFromPlainTextToken($request->api_token ?: '');
        });
    }
}
