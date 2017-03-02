<?php

namespace Application\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ManagerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('Domain\Manager\Contracts\OfferRepositoryContract', 'Infrastructure\Doctrine\Repositories\Manager\OfferRepository');

    }
}
