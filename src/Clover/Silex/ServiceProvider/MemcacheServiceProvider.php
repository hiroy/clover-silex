<?php
namespace Clover\Silex\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Usage:
 *   $app->register(new Clover\Silex\ServiceProvider\MemcacheServiceProvider(), [
 *        'memcached.servers' => [
 *            'host1:11211',
 *            'host2:11211',
 *        ],
 *   ]);
 */
class MemcacheServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['memcache'] = $app->share(function() use ($app) {
            $memcache = new \Memcache();
            if (isset($app['memcached.servers']) && is_array($app['memcached.servers'])) {
                foreach ($app['memcached.servers'] as $server) {
                    list($host, $port) = explode(':', $server);
                    $memcache->addServer($host, $port);
                }
            }
            return $memcache;
        });
    }

    public function boot(Application $app)
    {
    }
}
