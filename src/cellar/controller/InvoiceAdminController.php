<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 03-06-2015
 * Time: 3:21
 */

namespace cellar\Controller;


use cellar\Entity\CustomerPurchase;
use cellar\Entity\Purchase;
use cellar\Entity\Shopping;
use cellar\Form\Type\CustomerPurchaseType;
use cellar\Form\Type\PurchaseType;
use cellar\Form\Type\ShoppingType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class InvoiceAdminController
{
    //Proveedor
    public function providerAction(Request $request, Application $app)
    {
        $purchase = new Purchase();
        $form = $app['form.factory']->create(new PurchaseType(), $purchase);

        if ($request->isMethod('POST')) {

            $form->bind($request);
            $app['repository.shopping']->save($purchase);
            $message = 'La factura se ha guardado exitosamente';
            $app['session']->getFlashBag()->add('success', $message);

        }


        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 1000;//limite de filas 25.
        $total = $app['repository.shopping']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $products = $app['repository.shopping']->findAll($limit, $offset);

        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 1000;//limite de filas 25.
        $total = $app['repository.provider']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $providers = $app['repository.provider']->findAll($limit, $offset);

        return $app['twig']->render('administrator/provider.html.twig', array(
            'form' => $form->createView(),
            'shopping' => $purchase,
            'products' => $products,
            'providers' => $providers,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('cellar_dev_admin_provider')
        ));
    }

    //Cliente
    public function customerinvoiceAction(Request $request, Application $app)
    {


        $customerspurchase = new CustomerPurchase();
        $form = $app['form.factory']->create(new CustomerPurchaseType(), $customerspurchase);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            $app['repository.customerpurchase']->save($customerspurchase);
            $message = 'La factura se ha guardado exitosamente';
            $app['session']->getFlashBag()->add('success', $message);

        }

        $limit = 1000;//limite de filas 25.
        $total = $app['repository.shopping']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $products = $app['repository.shopping']->findAll($limit, $offset);


        $limit = 1000;//limite de filas 25.
        $total = $app['repository.customer']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $customers = $app['repository.customer']->findAll($limit, $offset);

        return $app['twig']->render('administrator/invoicecustomer.html.twig', array(
            'form' => $form->createView(),
            'products' => $products,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'customers' => $customers,
            'here' => $app['url_generator']->generate('cellar_dev_admin_invoicecustomer')
        ));
    }
}