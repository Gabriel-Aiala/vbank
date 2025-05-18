<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\PersonRepositoryInterface;
use App\Repositories\Eloquent\PersonRepository;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Eloquent\CompanyRepository;

use App\Repositories\Interfaces\EntityRepositoryInterface;
use App\Repositories\Eloquent\EntityRepository;

use App\Repositories\Interfaces\CredentialRepositoryInterface;
use App\Repositories\Eloquent\CredentialRepository;

use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Eloquent\BankAccountRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(EntityRepositoryInterface::class, EntityRepository::class);
        $this->app->bind(CredentialRepositoryInterface::class, CredentialRepository::class);
        $this->app->bind(BankAccountRepositoryInterface::class, BankAccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
