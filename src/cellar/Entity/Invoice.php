<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 07-06-2015
 * Time: 16:03
 */

namespace cellar\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

class Invoice
{
    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer",nullable="false")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;
    /**
     * var date $invoice_billingdate
     * @ORM\Column(name="invoice_billingdate",type="datetime")
     */
    protected $invoice_billingdate;

    /**
     * @var integer $id_customer
     * @ORM\Column(name="id_customer",type="integer",nullable="false")
     **/
    protected $id_customer;

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
     * @return mixed
     */
    public function getInvoiceBillingdate()
    {
        return $this->invoice_billingdate;
    }


    /**
     * @param DateTime|\DateTime $invoice_billingdate
     */
    public function setInvoiceBillingdate(\DateTime $invoice_billingdate)
    {
        $this->invoice_billingdate = $invoice_billingdate;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->id_customer;
    }

    /**
     * @param mixed $id_customer
     */
    public function setIdCustomer($id_customer)
    {
        $this->id_customer = $id_customer;
    }


}