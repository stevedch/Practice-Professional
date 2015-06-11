<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 02-06-2015
 * Time: 5:46
 */

namespace cellar\Controller;


use Silex\Application;

class AdminController
{
    public function indexAction(Application $app)
    {
        return $app->redirect($app['url_generator']->generate('cellar_dev_admin_users')); //Redireccionamiento a la pagina bbdo_chile.admin_users.
    }
}