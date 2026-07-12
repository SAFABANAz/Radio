<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Shared\Providers\SharedServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(SharedServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(\App\Providers\UserManagementServiceProvider::class);
        $this->app->register(\App\Providers\AuthenticationServiceProvider::class);
        $this->app->register(\Modules\Workflow\Providers\WorkflowServiceProvider::class);
        $this->app->register(\Modules\Documents\Providers\DocumentsServiceProvider::class);
        $this->app->register(\Modules\KYC\Providers\KycServiceProvider::class);
        $this->app->register(\Modules\Ledger\Providers\LedgerServiceProvider::class);
        $this->app->register(\Modules\Wallet\Providers\WalletServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
