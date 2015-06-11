<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 6:57
 */

namespace cellar\Controller;


use cellar\Entity\Customer;
use cellar\Entity\Provider;
use cellar\Form\Type\CustomerType;
use cellar\Form\Type\ProviderType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class RegisterAdminController
{

    public function registerAction(Request $request, Application $app)
    {
        $customer = new Customer();
        $form = $app['form.factory']->create(new CustomerType(), $customer);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.customer']->save($customer);

                $message = 'El cliente ' . $customer->getCustomerName() . ' se ha guardado';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }
        return $app['twig']->render('administrator/register.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function proveedorAction(Request $request, Application $app)
    {
        $provider = new Provider();
        $form = $app['form.factory']->create(new ProviderType(), $provider);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.provider']->save($provider);
                $message = 'El proveedor ' . $provider->getProviderName() . ' se ha guardado';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }
        return $app['twig']->render('administrator/register_provider.html.twig', array(
            'form' => $form->createView(),
            'provider' => $provider
        ));
    }
}