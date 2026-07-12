<?php

namespace Modules\KYC\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\KYC\Repositories\Eloquent\KycProfileRepository;
use Modules\KYC\Repositories\Interfaces\KycProfileRepositoryInterface;
use Modules\KYC\Repositories\Eloquent\KycRequestRepository;
use Modules\KYC\Repositories\Interfaces\KycRequestRepositoryInterface;
use Modules\KYC\Services\KycService;

class KycServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/kyc.php', 'kyc');

        $this->app->bind(KycRequestRepositoryInterface::class, KycRequestRepository::class);
        $this->app->bind(KycProfileRepositoryInterface::class, KycProfileRepository::class);

        $this->app->singleton(KycService::class, fn ($app) => new KycService(
            $app->make(KycRequestRepositoryInterface::class),
            $app->make(KycProfileRepositoryInterface::class)
        ));
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
