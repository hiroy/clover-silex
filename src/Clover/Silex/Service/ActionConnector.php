<?php
namespace Clover\Silex\Service;

use Silex\Application;
use Clover\Silex\Action\ActionInterface;

class ActionConnector
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function connect($instance)
    {
        if (!($instance instanceof ActionInterface)) {
            throw new \Exception('This instance cannot be connected.');
        }
        $requestMethod = $this->app['request']->getMethod();
        switch ($requestMethod) {
            case 'GET':
                return $instance->connectGet($this->app);
                break;
            case 'POST':
                return $instance->connectPost($this->app);
                break;
            case 'PUT':
                return $instance->connectPut($this->app);
                break;
            case 'DELETE':
                return $instance->connectDelete($this->app);
                break;
        }
    }
}
