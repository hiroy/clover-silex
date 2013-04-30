<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/autoload.php';

$app = null;

switch (getenv('CLOVER_ENV')) {
case 'prod':
    $app = require __DIR__ . '/bootstrap.prod.php';
    break;
case 'staging':
    $app = require __DIR__ . '/bootstrap.staging.php';
    break;
default:
    $app = require __DIR__ . '/bootstrap.local.php';
    break;
}

$app['is_login'] = false;
$app['self_user'] = null;

$app->register(new Clover\Silex\ServiceProvider\MaintenanceServiceProvider([
    'lock' => __DIR__ . '/../maintenance',
    'html' => __DIR__ . '/../web/maintenance.html'
]));

$app->error(function(\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    switch ($code) {
    case 404:
        return $app->render('error_404.html');
    default:
        return $app->render('error_default.html');
    }
});

$app->before(function() use ($app) {

    $app['self_user'] = null;
/*
    if ($app['session']->has('user_id')) {
        $userId = $app['session']->get('user_id');
        // TODO: login check
        if (false) { // login?
            $app['session']->invalidate();
        } else {
            $app['is_login'] = true;
            $app['self_user'] = $user;
        }
    }

    $app['twig']->addGlobal('messages', $app['messages']->all());

    $app['twig']->addGlobal('security_token_name',
        Clover\Silex\Service\SecurityTokenValidator::SECURITY_TOKEN_ITEM_NAME);
*/
});

/* Sample
if (!$app['maintenance.enabled']) {
    $app->mount('/', new Example\ControllerProvider\DefaultControllerProvider());
}
*/

return $app;
