<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 08-06-2015
 * Time: 5:47
 */

namespace cellar\Controller;


use cellar\Entity\Category;
use cellar\Entity\Product;
use cellar\Form\Type\ProductsType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ProductsController
{

    public function addAction(Request $request, Application $app)
    {

        $product = new Product();


        $form = $app['form.factory']->create(new ProductsType(), $product);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $app['repository.products']->save($product);

                $message = 'El producto ' . $product->getProductName() . ' se ha guardado';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }


        return $app['twig']->render('administrator/productsadd.html.twig', array(
            'form' => $form->createView(),
            'products' => $product
        ));
    }
}