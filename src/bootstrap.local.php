<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

$app = new Clover\Silex\Application();

$app['debug'] = true;
$app['env'] = 'local';

$app['static_files'] = require __DIR__ . '/static_files.php';

/*
$app->register(new Silex\Provider\SessionServiceProvider());
$app['pdo.dsn'] = 'mysql:dbname=dbname;host=127.0.0.1;charset=utf8mb4';
$app['pdo.user'] = 'dbuser';
$app['pdo.password'] = 'dbpassword';
$app['pdo.db_options'] = [
    'db_table'    => 'session',
    'db_id_col'   => 'session_id',
    'db_data_col' => 'session_value',
    'db_time_col' => 'session_time',
];
$app['pdo'] = $app->share(function () use ($app) {
    return new PDO(
        $app['pdo.dsn'],
        $app['pdo.user'],
        $app['pdo.password']
    );
});
$app['session.storage.handler'] = $app->share(function () use ($app) {
    return new PdoSessionHandler(
        $app['pdo'],
        $app['pdo.db_options'],
        $app['session.storage.options']
    );
});

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => 'pdo_mysql',
        'dbname'   => 'dbname',
        'host'     => '127.0.0.1',
        'user'     => $app['pdo.user'],
        'password' => $app['pdo.password'],
        'charset'  => 'utf8mb4',
    ],
]);
*/

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views',
    'twig.options' => [
        'debug' => true,
    ]
]);

/* using Monolog for logging?
$app->register(new Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => __DIR__. '/../log/development.log',
    'monolog.level' => Monolog\Logger::INFO,
    'monolog.name' => 'example',
]);
*/

/* using Twitter?
$app['tmhoauth.config'] = [
    'consumer_key' => 'your consumer key',
    'consumer_secret' => 'your consumer secret',
];
$app->register(new Kud\Silex\Provider\TmhOAuthServiceProvider());
*/

$app['messages'] = $app->share(function() use ($app) {
    return new Clover\Silex\Service\Messages($app);
});
$app['errors'] = $app->share(function() use ($app) {
    return new Clover\Silex\Service\Errors($app);
});
$app['security_token_validator'] = $app->share(function() {
    return new Clover\Silex\Service\SecurityTokenValidator();
});

return $app;
