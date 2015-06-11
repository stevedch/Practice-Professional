<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;


if (isset($app)) {
    $app['controllers']->convert('user', function ($id) use ($app) {
        if ($id) return $app['repository.user']->find($id);
    });
}

if (isset($app)) {
    $app['controllers']->convert('provider', function ($id) use ($app) {
        if ($id) return $app['repository.provider']->find($id);
    });
}

if (isset($app)) {
    $app['controllers']->convert('products', function ($id) use ($app) {
        if ($id) return $app['repository.products']->find($id);
    });
}
//Url para los usuarios estándares. HOMEPAGE
if (isset($app)) $app->get('/', 'cellar\Controller\IndexController::indexAction')->bind('cellar_dev_homepage'); //Url de inicio de sesión.
if (isset($app)) $app->match('/login', 'cellar\Controller\UserController::loginAction')->bind('cellar_dev_login');//Redirección al formulario de inicio de sesión.
if (isset($app)) $app->get('/logout', 'cellar\Controller\UserController::logoutAction')->bind('cellar_dev_logout');//Cerrar sesión.
//Url de administración.
if (isset($app)) $app->get('/administracion/', 'cellar\Controller\AdminController::indexAction')->bind('cellar_dev_administrator'); //Redireccionamiento a la pagina cellar.admin_users.
//CRUD select,insert,update,delete.
if (isset($app)) $app->get('/administracion/usuarios/', 'cellar\Controller\UserAdminController::indexAction')->bind('cellar_dev_admin_users'); //Genera una vista de la tabla usuario.
if (isset($app)) $app->match('/administracion/usuarios/agregar/', 'cellar\Controller\UserAdminController::addAction')->bind('cellar_dev_admin_users_add'); //formulario de agregar usuario.
if (isset($app)) $app->match('/administracion/usuarios/{user}/editar/', 'cellar\Controller\UserAdminController::editAction')->bind('cellar_dev_admin_users_edit'); //formulario de edición usuario.
if (isset($app)) $app->match('/administracion/usuarios/{user}/eliminar/', 'cellar\Controller\UserAdminController::deleteAction')->bind('cellar_dev_admin_users_delete');//Link de eliminación usuario.
//Generando urls para el usuario operador vista factura proveedor y cliente.
if (isset($app)) $app->match('/administracion/factura/proveedor/', 'cellar\Controller\InvoiceAdminController::providerAction')->bind('cellar_dev_admin_provider');
if (isset($app)) $app->match('/administracion/factura/cliente/', 'cellar\Controller\InvoiceAdminController::customerinvoiceAction')->bind('cellar_dev_admin_invoicecustomer');
//Vista de detalle de ventas y compra prooveedor y  cliente.
if (isset($app)) $app->match('/administracion/Reporte/compra/proveedor/', 'cellar\Controller\ManagerAdminController::reportpurcharseProviderAction')->bind('cellar_dev_admin_report_provider_purchase_products');
if (isset($app)) $app->match('/administracion/Reporte/venta/cliente/', 'cellar\Controller\ManagerAdminController::reportsaleCustomerinvoiceAction')->bind('cellar_dev_admin_reportcustomer_sale_products');
//Registro Customer
if (isset($app)) $app->match('/administracion/register/cliente/', 'cellar\Controller\RegisterAdminController::registerAction')->bind('cellar_administrative_customer_register');
if (isset($app)) $app->match('/administracion/register/proveedor/', 'cellar\Controller\RegisterAdminController::proveedorAction')->bind('cellar_administrative_customer_register_proveedor');
if (isset($app)) $app->match('/administracion/operador/ingresar/producto/', 'cellar\Controller\ProductsController::addAction')->bind('cellar_dev_products_add_category'); //Genera una vista de la tabla proveedores.
//Show providers functions delete,update
if (isset($app)) $app->get('/administracion/administradorgeneral/proveedor/', 'cellar\Controller\ProviderController::indexAction')->bind('cellar_dev_providers_users'); //Genera una vista de la tabla proveedores.
if (isset($app)) $app->get('/administracion/administradorgeneral/productoscategorias/', 'cellar\Controller\ProviderController::productscatAction')->bind('cellar_dev_products_categories'); //Genera una vista de la tabla proveedores.
if (isset($app)) $app->match('/administracion/administradorgeneral/productoscategorias/{products}/editar/', 'cellar\Controller\ProviderController::editProductscatAction')->bind('cellar_dev_edit_products_categories'); //Genera una vista de la tabla productos.
if (isset($app)) $app->match('/administracion/administradorgeneral/productoscategorias/{products}/eliminar/', 'cellar\Controller\ProviderController::deleteProductscatAction')->bind('cellar_dev_delete_products_categories'); //Genera una vista de la tabla productos.
if (isset($app)) $app->match('/administracion/administradorgeneral/proveedor/{provider}/editar/', 'cellar\Controller\ProviderController::editAction')->bind('cellar_dev_providers_users_edit'); //formulario de edición provedores.
if (isset($app)) $app->match('/administracion/administradorgeneral/proveedor/{provider}/eliminar/', 'cellar\Controller\ProviderController::deleteAction')->bind('cellar_dev_providers_users_delete');//Link de eliminación provedores.
//Errores de páginas
if (isset($app)) {
    $app->error(function (\Exception $e, $code) use ($app) {
        if ($app['debug']) {
            return $app;
        }
        // 404.html, or 40x.html, or 4xx.html, or error.html
        $templates = array(
            'errors/' . $code . '.html.twig',
            'errors/' . substr($code, 0, 2) . 'x.html.twig',
            'errors/' . substr($code, 0, 1) . 'xx.html.twig',
            'errors/default.html',
        );
        return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code, $e);
    });
}
