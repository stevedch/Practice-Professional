<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 6:05
 */

namespace cellar\Entity;

use Doctrine\ORM\Mapping as ORM;

class Customer
{
    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer",nullable="false")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/

    protected $id;
    /**
     * @var string $customer_rut
     * @ORM\Column(name="customer_rut",type="string",length="9",nullable="true")
     * */
    protected $customer_rut;
    /**
     * @var string $customer_name
     * @ORM\Column(name="customer_name",type="string",length="80",nullable="true")
     * */
    protected $customer_name;
    /**
     * @var string $customer_lastname
     * @ORM\Column(name="customer_lastname",type="string",length="80",nullable="true")
     * */
    protected $customer_lastname;

    /**
     * @var string $customer_motherslastname
     * @ORM\Column(name="customer_motherslastname",type="string",length="80",nullable="true")
     * */
    protected $customer_motherslastname;

    /**
     * @var string $customer_address
     * @ORM\Column(name="customer_address",type="string",length="120",nullable="true")
     * */
    protected $customer_address;

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
    public function getCustomerRut()
    {
        return $this->customer_rut;
    }

    /**
     * @param string $customer_rut
     */
    public function setCustomerRut($customer_rut)
    {
        $this->customer_rut = $customer_rut;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customer_name;
    }

    /**
     * @param string $customer_name
     */
    public function setCustomerName($customer_name)
    {
        $this->customer_name = $customer_name;
    }

    /**
     * @return string
     */
    public function getCustomerLastname()
    {
        return $this->customer_lastname;
    }

    /**
     * @param string $customer_lastname
     */
    public function setCustomerLastname($customer_lastname)
    {
        $this->customer_lastname = $customer_lastname;
    }

    /**
     * @return string
     */
    public function getCustomerMotherslastname()
    {
        return $this->customer_motherslastname;
    }

    /**
     * @param string $customer_motherslastname
     */
    public function setCustomerMotherslastname($customer_motherslastname)
    {
        $this->customer_motherslastname = $customer_motherslastname;
    }


    /**
     * @return string
     */
    public function getCustomerAddress()
    {
        return $this->customer_address;
    }

    /**
     * @param string $customer_address
     */
    public function setCustomerAddress($customer_address)
    {
        $this->customer_address = $customer_address;
    }

}