<?php

// configure your app for the production environment
//activar $app['debug'] = true  para  la visualización de errores en el entorno de producción //prod / dev
//$app['debug'] = true;
$app['twig.path'] = array('../src/cellar/Templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');