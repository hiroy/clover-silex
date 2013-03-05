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

    public function add($message)
    {
        $this->app['session']->getFlashBag()->add('message', $message);
    }

    public function get(array $default = [])
    {
        return $this->app['session']->getFlashBag()->get('message', $default);
    }
}
