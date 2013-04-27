<?php
namespace Clover\Silex\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class TmhOAuthServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['tmhoauth'] = $app->share(function() use ($app) {
            return new \tmhOAuth([
                'consumer_key' => $app['tmhoauth.consumer_key'],
                'consumer_secret' => $app['tmhoauth.consumer_secret'],
            ]);
        });
    }

    public function boot(Application $app)
    {
    }
}
