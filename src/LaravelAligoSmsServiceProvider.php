<?php


namespace Visualplus\LaravelAligoSms;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class LaravelAligoSmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/aligo-sms.php' => config_path('aligo-sms.php'),
        ]);
    }

    /**
     * Register the service provider
     */
    public function register()
    {
        $this->app->singleton(AligoSmsSender::class, function() {
            return new AligoSmsSender(
                new Client(),
                [
                    'userid' => config('aligo-sms.userid'),
                    'key' => config('aligo-sms.key'),
                    'sender' => config('aligo-sms.sender'),
                ]
            );
        });
    }
}