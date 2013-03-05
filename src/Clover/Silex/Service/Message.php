<?php
namespace Clover\Silex\Service;

use Silex\Application;

class Message
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function set($message)
    {
        $this->app['session']->getFlashBag()->set('message', $message);
    }

    public function get($default = null)
    {
        return $this->app['session']->getFlashBag()->get('message', $default);
    }
}
