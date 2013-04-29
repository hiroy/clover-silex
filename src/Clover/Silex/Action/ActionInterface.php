<?php
namespace Clover\Silex\Action;

use Silex\Application;

interface ActionInterface
{
    public function connectGet(Application $app);
    public function connectPost(Application $app);
    public function connectPut(Application $app);
    public function connectDelete(Application $app);
}
