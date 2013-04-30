<?php
namespace Clover\Silex\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Usage:
 *
 * $app->register(Clover\Silex\ServiceProvider\MaintenanceServiceProvider([
 *     'lock' => __DIR__ . '/../maintenance',
 *     'html' => __DIR__ . '/../web/maintenance.html',
 * ]));
 */
class MaintenanceServiceProvider implements ServiceProviderInterface
{
    protected $isMaintenanceMode = false;
    protected $htmlFile;

    public function __construct(array $options)
    {
        if (isset($options['lock'])) {
            $this->isMaintenanceMode = is_file($options['lock']);
        }
        if (isset($options['html'])) {
            if (is_file($options['html']) && is_readable($options['html'])) {
                $this->htmlFile = $options['html'];
            }
        }
    }

    public function register(Application $app)
    {
        if ($this->isMaintenanceMode && !is_null($this->htmlFile)) {
            $app['maintenance.html'] = file_get_contents($this->htmlFile);
            $app->match('/{path}', function() use ($app) {
                return new Response($app['maintenance.html'], 503);
            })->assert('path', '.*');
        }
    }

    public function boot(Application $app)
    {
    }
}
