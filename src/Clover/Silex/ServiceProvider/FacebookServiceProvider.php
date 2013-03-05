<?php
namespace Clover\Silex\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class FacebookServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['facebook'] = $app->share(function() use ($app) {
            return new \Facebook([
                'appId'  => $app['facebook.app_id'],
                'secret' => $app['facebook.secret'],
            ]);
        });
    }

    public function boot(Application $app)
    {
    }
}
