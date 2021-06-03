<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\SMSOTPService;
class SMSOTPProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         $this->app->bind(SMSOTPService::class);
    }
}
