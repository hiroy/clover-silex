<?php
namespace Clover\Silex\Service;

use Silex\Application;

class ActionConnector
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function connect($instance)
    {
        if (!$instance instanceof Clover\Sliex\Action\ActionInterface) {
            throw new \Exception('This instance cannot be connected.');
        }
        $requestMethod = $app['request']->getMethod();
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
