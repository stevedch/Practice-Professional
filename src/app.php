<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Silex\Application;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\FormServiceProvider;


$app = new Application();
$app->register(new DoctrineOrmServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new SwiftmailerServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new SecurityServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new FormServiceProvider());


//Conexión ha base de datos  cellar_prod
$app->register(new DoctrineServiceProvider(), array(
    'dbs.options' => array(
        'mysql_read' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'dev_wine_cellar',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'mysql_write' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'dev_wine_cellar',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    ),
));

$app->register(new DoctrineOrmServiceProvider(), array(
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "yml",
                "namespace" => "Entity",
                "path" => realpath(__DIR__ . "/../config/doctrine"),
            ),
        ),
    ),
));

//Registro para el envío de mensajes
$app->register(new SwiftmailerServiceProvider(), array(
    'swiftmailer.options' => array(
        'host' => 'mail.dominio.cl',
        'port' => '25',
        'username' => 'usuariodehos',
        'password' => 'admin123',
        'encryption' => null,
        'auth_mode' => null
    ),
));

//Registro para la seguridad de url - ejm Administrador
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'admin' => array(
            'pattern' => '^/',
            'form' => array(
                'login_path' => '/login',
                'check_path' => '/administrator/login_check',
                'username_parameter' => 'form[username]',
                'password_parameter' => 'form[password]',
            ),
            'logout' => true,
            'anonymous' => true,
            'users' => $app->share(function () use ($app) {
                return new cellar\Repository\UserRepository($app['db'], $app['security.encoder.digest']);
            }),
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_SUPER_ADMIN' => array('ROLE_USER'), //ROLE_SUPER_ADMIN visualización y acceso total ejm: array('ROLE_ADMIN','ROLE_RRHH_ADMIN') -> acceso total sobre todos los roles
        'ROLE_GERENTE' => array('ROLE_USER'),
        'ROLE_OPERADOR' => array('ROLE_USER')
    ),
));

//Protección de urls y redireccionamiento, si el usuario no tiene los privilegios
$app->before(function (Request $request) use ($app) {
    $protected = array(
        '/administracion/' => array('ROLE_SUPER_ADMIN', 'ROLE_GERENTE', 'ROLE_OPERADOR'), //accesso denegado para usuarios que no cumplas los roles del array
        '/me' => 'ROLE_USER',
    );
    $path = $request->getPathInfo();
    foreach ($protected as $protectedPath => $role) {
        if (strpos($path, $protectedPath) !== FALSE && !$app['security']->isGranted($role)) {
            throw new AccessDeniedException();
        }
    }
});


//Registro de los  repositorios
$app['repository.user'] = $app->share(function ($app) {
    return new cellar\Repository\UserRepository($app['db'], $app['security.encoder.digest']);
});

$app['repository.shopping'] = $app->share(function ($app) {
    return new cellar\Repository\PurchaseRepository($app['db']);
});

$app['repository.customer'] = $app->share(function ($app) {
    return new cellar\Repository\CustomerRepository($app['db']);
});

$app['repository.provider'] = $app->share(function ($app) {
    return new cellar\Repository\ProviderRepository($app['db']);
});

$app['repository.customerpurchase'] = $app->share(function ($app) {
    return new cellar\Repository\CustomerpurcharseRepository($app['db']);
});

$app['repository.ReportDetailRepository'] = $app->share(function ($app) {
    return new cellar\Repository\ReportDetailRepository($app['db']);
});
$app['repository.ReportDetailProviderRepository'] = $app->share(function ($app) {
    return new cellar\Repository\ReportDetailProviderRepository($app['db']);
});

$app['repository.products'] = $app->share(function ($app) {
    return new cellar\Repository\ProductsRepository($app['db']);
});

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translation.messages' => array(),
));

$app['twig'] = $app->share($app->extend('twig', function ($twig) {
    return $twig;
}));

return $app;