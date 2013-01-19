<?php
namespace Clover\Service;

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
        $this->app['session']->setFlash('message', $message);
    }

    public function get($default = null)
    {
        return $this->app['session']->getFlash('message', $default);
    }
}
