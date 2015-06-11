<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 01-06-2015
 * Time: 7:28
 */

namespace cellar\Controller;


use Silex\Application;

class IndexController
{

    public function  indexAction(Application $app)
    {

        return $app['twig']->render('home/index.html.twig', array());
    }
}