<?php
namespace Clover\Silex\Service;

use Silex\Application;

class SecurityTokenValidator
{
    const SECURITY_TOKEN_ITEM_NAME = 'security_token';

    public function validate(Application $app)
    {
        $savedToken = $app['session']->getId();
        $postedToken = $app['request']->request->get(self::SECURITY_TOKEN_ITEM_NAME);
        if (!is_null($postedToken) && $postedToken === $savedToken) {
            return true;
        }
        return false;
    }
}
