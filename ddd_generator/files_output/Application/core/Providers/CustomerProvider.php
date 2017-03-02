<?php

namespace Application\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('Domain\Customer\Contracts\OrderRepositoryContract', 'Infrastructure\Doctrine\Repositories\Customer\OrderRepository');

    }
}
