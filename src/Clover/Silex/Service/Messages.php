<?php
namespace Clover\Silex\Service;

use Silex\Application;

class Messages
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function add($message)
    {
        $this->app['session']->getFlashBag()->add('messages', $message);
    }

    public function all(array $default = [])
    {
        return $this->app['session']->getFlashBag()->get('messages', $default);
    }
}
