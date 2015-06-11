<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 21:20
 */

namespace cellar\Entity;

use Doctrine\ORM\Mapping as ORM;

class Provider
{
    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer",nullable="false")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/

    protected $id;
    /**
     * @var string $provider_name
     * @ORM\Column(name="provider_name",type="string",length="80",nullable="true")
     * */
    protected $provider_name;
    /**
     * @var string $provider_telephone
     * @ORM\Column(name="provider_telephone",type="string",length="45",nullable="true")
     * */
    protected $provider_telephone;
    /**
     * @var string $provider_address
     * @ORM\Column(name="provider_address",type="string",length="120",nullable="true")
     * */
    protected $provider_address;

    /**
     * @return int
     */
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
     * @return string
     */
    public function getProviderName()
    {
        return $this->provider_name;
    }

    /**
     * @param string $provider_name
     */
    public function setProviderName($provider_name)
    {
        $this->provider_name = $provider_name;
    }

    /**
     * @return string
     */
    public function getProviderTelephone()
    {
        return $this->provider_telephone;
    }

    /**
     * @param string $provider_telephone
     */
    public function setProviderTelephone($provider_telephone)
    {
        $this->provider_telephone = $provider_telephone;
    }

    /**
     * @return string
     */
    public function getProviderAddress()
    {
        return $this->provider_address;
    }

    /**
     * @param string $provider_address
     */
    public function setProviderAddress($provider_address)
    {
        $this->provider_address = $provider_address;
    }



}