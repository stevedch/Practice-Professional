<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 19:39
 */

namespace cellar\Controller;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ManagerAdminController
{

    public function  reportpurcharseProviderAction(Request $request, Application $app)
    {
        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 25;//limite de filas 25.
        $total = $app['repository.ReportDetailProviderRepository']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $reportprovider = $app['repository.ReportDetailProviderRepository']->findAll($limit, $offset);

        return $app['twig']->render("administrator/reportpurchaseprovider.html.twig", array(
            'reportproviders' => $reportprovider,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('cellar_dev_admin_report_provider_purchase_products')
        ));
    }

    public function reportsaleCustomerinvoiceAction(Request $request, Application $app)
    {

        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 25;//limite de filas 25.
        $total = $app['repository.ReportDetailRepository']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $reportCustomers = $app['repository.ReportDetailRepository']->findAll($limit, $offset);


        return $app['twig']->render("administrator/reportsalecustomer.html.twig", array(
            'reportCustomers' => $reportCustomers,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('cellar_dev_admin_reportcustomer_sale_products')
        ));
    }

}