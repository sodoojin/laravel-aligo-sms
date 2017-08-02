<?php


namespace Visualplus\LaravelAligoSms;

use Apikr\Aligo\Sms\Configuration;
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
            $httpClient = new Client();

            $conf = new Configuration([
                'id' => config('aligo-sms.userid'),
                'apikey' => config('aligo-sms.key'),
                'sender' => config('aligo-sms.sender'),
            ]);

            return new AligoSmsSender($httpClient, $conf);
        });
    }
}