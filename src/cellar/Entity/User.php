<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 01-06-2015
 * Time: 22:38
 */

namespace cellar\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer",nullable="false")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @var string $username
     * @ORM\Column(name="username",type="string",length="80",nullable="true")
     * */
    protected $username;
    /**
     * @var string $password
     * @ORM\Column(name="password",type="string",length="255",nullable="true")
     * */
    protected $password;

    /**
     * @var string $mail
     * @ORM\Column(name="mail",type="string",length="255",nullable="false")
     * */

    protected $mail;

    /**
     * var date $created_at
     * @ORM\Column(name="created_at",type="timestamp",nullable="false")
     */
    protected $created_at;


    /**
     * @var boolean $status_user
     * @ORM\Column(name="status_user",type="boolean")
     * */

    protected $status_user;


    /**
     * @var string $salt
     * @ORM\Column(name="salt",type="string",length="255",nullable="true")
     * */
    protected $salt;

    /**
     * ROLE_USER or ROLE_ADMIN.
     * @var string $role
     * @ORM\Column(name="role",type="string",length="80",nullable="true")
     * */
    protected $role;

    /**
     * @return int
     * */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }


    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime|DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return boolean
     */
    public function getStatusUser()
    {
        return $this->status_user;
    }

    /**
     * @param boolean $status_user
     */
    public function setStatusUser($status_user)
    {
        $this->status_user = $status_user;
    }


    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array(
            $this->getRole()
        );
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}