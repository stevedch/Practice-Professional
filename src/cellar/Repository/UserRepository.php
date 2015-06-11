<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 01-06-2015
 * Time: 22:20
 */

namespace cellar\Repository;

use Doctrine\DBAL\Connection;
use cellar\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserRepository implements RepositoryInterface, UserProviderInterface
{

    /**
     * @var  \Doctrine\DBAL\Connection
     * */


    protected $database;


    /**
     * @var \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder
     * */

    protected $encoder;

    public function __construct(Connection $db, $encoder)
    {
        $this->database = $db;
        $this->encoder = $encoder;
    }

    public function save($user)
    {
        /**
         * @var \cellar\Entity\User $user
         */

        $userData = array
        (
            'username' => $user->getUsername(),
            'mail' => $user->getMail(),
            'status_user' => $user->getStatusUser(),
            'role' => $user->getRole()
        );
        //Si se cambio la contraseña, vuela a cifrarlo.
        if (strlen($user->getPassword()) != 88) {
            $userData['salt'] = uniqid(mt_rand());
            $userData['password'] = $this->encoder->encodePassword($user->getPassword(), $userData['salt']);
        }

        if ($user->getId()) {
            $this->database->update('user', $userData, array('id' => $user->getId()));

        } else {
            //El usuario es nuevo, tenga en cuenta la fecha y hora de creación.
            $this->database->insert('user', $userData);
            // Obtener el ID del usuario recién creado y lo asigna sobre la entidad.
            $id = $this->database->lastInsertId();
            $user->setId($id);
        }

        return $user;
    }

    /**
     * Retorna el total de usuarios existentes en la base de datos.
     * @return integer The total number of user.
     */

    public function getCount()
    {
        return $this->database->fetchColumn('SELECT COUNT(id) FROM user');
    }

    /**
     * Retorna un id de usuario, que coincida con el id suministrado.
     * @param integer $id
     * @return \cellar\Entity\User|false Un objeto de entidad si se encuentra, false en caso contrario.
     */
    public function find($id)
    {
        $userData = $this->database->fetchAssoc('SELECT * FROM user WHERE id = ?', array($id));
        return $userData ? $this->buildUser($userData) : FALSE;
    }

    /**
     * Devuelve una colección de usuarios.
     * @param integer $limit
     *   El número de usuarios para volver.
     * @param integer $offset
     *   El número de usuarios para saltar.
     * @param array $orderBy
     *   Opcionalmente, el orden de información, en el $column => $direction format.
     * @return array A collection of users, keyed by user id.
     */
    public function findAll($limit, $offset = 1, $orderBy = array())
    {
        if (!$orderBy) {
            $orderBy = array('id' => 'ASC');
        }
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('user', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('u.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();
        $users = array();
        foreach ($usersData as $userData) {
            $userId = $userData['id'];
            $users[$userId] = $this->buildUser($userData);
        }
        return $users;
    }

    /**
     * @param integer $id
     * @return int
     */
    public function delete($id)
    {
        return $this->database->delete('user', array('id' => $id));
    }


    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('user', 'u')
            ->where('u.username = :username OR u.mail = :mail')
            ->setParameter('username', $username)
            ->setParameter('mail', $username)
            ->setMaxResults(1);
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();
        if (empty($usersData)) {
            throw new UsernameNotFoundException(sprintf('El usuario "%s" no se ha encontrado.', $username));
        }
        $user = $this->buildUser($usersData[0]);

        return $user;
    }


    /**
     * {@inheritDoc}
     * @var \cellar\Entity\User $user
     */


    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Las instancias de "%s" no son compatibles.', $class));
        }
        $id = $user->getId();
        $refreshedUser = $this->find($id);
        if (false === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('Usuario con id "%s"s no encontrado', json_encode($id)));
        }
        return $refreshedUser;
    }


    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'cellar\Entity\User' === $class;
    }

    /**
     * Ejemplariza una entidad usuario, establece sus propiedades utilizando datos db.
     * @param array $userData The array of db data.
     * @return \cellar\Entity\User
     */
    protected function buildUser($userData)
    {
        $user = new User();
        $user->setId($userData['id']);
        $user->setUsername($userData['username']);
        $user->setPassword($userData['password']);
        $user->setMail($userData['mail']);
        $user->setSalt($userData['salt']);
        $user->setStatusUser($userData['status_user']);
        $user->setRole($userData['role']);
        $createdAt = new \DateTime($userData['created_at']);
        $user->setCreatedAt($createdAt);


        return $user;

    }
}