<?php
namespace Clover\Silex\Service;

use Silex\Application;

class Errors
{
    private $app;
    private $errors = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function add($message)
    {
        $this->errors[] = $message;
    }

    public function hasAny()
    {
        return count($this->errors) > 0;
    }

    public function all()
    {
        return $this->errors;
    }

    public function join()
    {
        return implode('', $this->errors);
    }
}
