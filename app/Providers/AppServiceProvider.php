<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\BaseRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\CovidStatisticRepository;
use App\Repositories\CovidStatisticRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CovidStatisticRepositoryInterface::class, CovidStatisticRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
