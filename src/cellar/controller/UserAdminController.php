<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 02-06-2015
 * Time: 5:48
 */

namespace cellar\Controller;


use Silex\Application;
use cellar\Form\Type\UserType;
use cellar\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserAdminController
{
    //Paginación limite de filas 25.
    public function indexAction(Request $request, Application $app)
    {
        //Realización de logica de paginación
        // Realizar lógica paginación.
        $limit = 25;//limite de filas 25.
        $total = $app['repository.user']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $users = $app['repository.user']->findAll($limit, $offset);

        return $app['twig']->render('administrator/index.html.twig', array(
            'users' => $users,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('cellar_dev_admin_users'), //Genera una vista de usuarios.
        ));
    }


    //Funcción Agregar
    public function addAction(Request $request, Application $app)
    {
        $user = new User();
        $form = $app['form.factory']->create(new UserType(), $user);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.user']->save($user);

                $message = 'El usuario' . $user->getUsername() . 'se ha guardado';
                $app['session']->getFlashBag()->add('success', $message);

                //Redireccionar a la página de edición.
                $redirect = $app['url_generator']->generate('cellar_dev_admin_users_edit', array('user' => $user->getId()));
                return $app->redirect($redirect);
            }
        }


        return $app['twig']->render('administrator/add.html.twig', array(
            'form' => $form->createView(),
            'title' => 'REGISTRO DE EMPLEADOS',
            'user' => $user
        ));

    }


    //Edición de  usuarios
    public function editAction(Request $request, Application $app)
    {
        $user = $request->attributes->get('user');
        if (!$user) {
            $app->abort(404, 'No se encontro el usuario solicitado.');
        }

        /**
         * @var \cellar\Entity\User $user
         * */

        $form = $app['form.factory']->create(new UserType(), $user);

        if ($request->isMethod('POST')) {

            $previousPassword = $user->getPassword();
            $prevNameUser = $user->getUsername();
            $prevRol = $user->getRole();
            $prevStatus = $user->getStatusUser();

            $form->bind($request);

            if ($form->isValid()) {
                //Si se introdujo una contraseña vacía, restaurar la anterior.
                $password = $user->getPassword();
                if (!$password) $user->setPassword($previousPassword);
                $usern = $user->getUsername();
                if (!$usern) $user->setUsername($prevNameUser);
                $roluser = $user->getRole();
                if (!$roluser) $user->setRole($prevRol);
                $userStat = $user->getStatusUser();
                if (!$userStat) $user->setStatusUser($prevStatus);

                $user = $app['repository.user']->save($user);

                //var_dump($user);
                $message = 'El usuario ' . " " . $user->getUsername() . ' se ha guardado.';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }

        return $app['twig']->render('administrator/add.html.twig', array(
            'form' => $form->createView(),
            'title' => 'EDITAR USUARIO' . " " . $user->getUsername(),
            'user' => $user,
        ));
    }


    //Eliminar usuarios añadir a  una url para borrar usuario
    public function deleteAction(Request $request, Application $app)
    {
        /**
         * @var \cellar\Entity\User $user
         * */

        $user = $request->attributes->get('user');

        if (!$user) {
            $app->abort(404, 'No se encontró el usuario solicitado.');
        }

        $app['repository.user']->delete($user->getId());
        return $app->redirect($app['url_generator']->generate('cellar_dev_admin_users'));
    }

}