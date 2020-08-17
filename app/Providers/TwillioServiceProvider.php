<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class TwillioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( 'sync', function () {

            $client = new \Twilio\Rest\Client(
                env('TWILIO_ACCOUNT_SID'),
                env('TWILIO_ACCOUNT_TOKEN')
            );

            return $client->sync->services(
                env('TWILIO_SYNC_SERVICE_SID')
            );
        } );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
