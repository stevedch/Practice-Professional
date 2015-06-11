<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 08-06-2015
 * Time: 3:22
 */

namespace cellar\Controller;


use cellar\Entity\Product;
use cellar\Entity\Provider;
use cellar\Form\Type\ProductsType;
use cellar\Form\Type\ProviderType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ProviderController
{

    public function indexAction(Request $request, Application $app)
    {

        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 1000;//limite de filas 25.
        $total = $app['repository.provider']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $providers = $app['repository.provider']->findAll($limit, $offset);

        return $app['twig']->render('administrator/showproviders.html.twig', array(
            'providers' => $providers,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('cellar_dev_providers_users')
        ));
    }

    public function productscatAction(Request $request, Application $app)
    {

        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 1000;//limite de filas 25.
        $total = $app['repository.products']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $products = $app['repository.products']->findAll($limit, $offset);


        return $app['twig']->render('administrator/productsshow.html.twig', array(
            'product' => $products,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('cellar_dev_providers_users')
        ));

    }

    public function editAction(Request $request, Application $app)
    {
        $provider = $request->attributes->get('provider');

        if (!$provider) {
            $app->abort(404, "No se encontro el proveedor solicitado");
        }

        /**
         * @var \cellar\Entity\Provider $provider
         * */

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


    public function  editProductscatAction(Request $request, Application $app)
    {

        $product = $request->attributes->get('products');

        if (!$product) {
            $app->abort(404, "No se encontro el producto solicitado");
        }

        /**
         * @var \cellar\Entity\Product $product
         * */


        $form = $app['form.factory']->create(new ProductsType(), $product);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $app['repository.products']->save($product);

                $message = 'El producto ' . $product->getProductName() . ' se ha modificado';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }

        return $app['twig']->render('administrator/productsadd.html.twig', array(
            'form' => $form->createView(),
            'products' => $product
        ));
    }

    public function deleteProductscatAction(Request $request, Application $app)
    {
        /**
         * @var \cellar\Entity\Product $product
         * */
        $product = $request->attributes->get('products');

        if (!$product) {
            $app->abort(404, 'No se encontró el producto solicitado');
        }

        $app['repository.products']->delete($product->getId());
        return $app->redirect($app['url_generator']->generate('cellar_dev_products_categories'));
    }

    public function deleteAction(Request $request, Application $app)
    {
        /**
         * @var \cellar\Entity\Provider $provider
         * */
        $user = $request->attributes->get('provider');

        if (!$user) {
            $app->abort(404, 'No se encontró el usuario solicitado.');
        }
        $app['repository.provider']->delete($user->getId());
        return $app->redirect($app['url_generator']->generate('cellar_dev_providers_users'));
    }

}
