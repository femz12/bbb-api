<?php

namespace DavidO\BBBApi;

use BigBlueButton\BigBlueButton;
use DavidO\BBBApi\Contracts\Meeting;
use Illuminate\Support\ServiceProvider;

class BigbluebuttonProviderService extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/config/bbb.php' => config_path('bbb.php')], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/bbb.php', 'bigbluebutton');
        $server_base_url = $this->app['config']->get('bigbluebutton.BBB_SERVER_BASE_URL');
        $server_salt = $this->app['config']->get('bigbluebutton.BBB_SECURITY_SALT');

        putenv("BBB_SERVER_BASE_URL=$server_base_url");
        putenv("BBB_SECURITY_SALT=$server_salt");

        $this->app->bind('bigbluebutton', function ($app) {
            return new BigBlueButton();
        });

        $this->app->alias('bigbluebutton', BigBlueButton::class);

        $this->app->bind('bigbluebutton_meeting', function ($app) {
            return new BigbluebuttonMeeting($app['bigbluebutton']);
        });

        $this->app->bind(Meeting::class, function ($app) {
            return new BigbluebuttonMeeting($app['bigbluebutton']);
        });
    }
}
