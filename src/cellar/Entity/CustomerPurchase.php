<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 15:05
 */

namespace cellar\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

class CustomerPurchase
{

    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer")
     **/

    protected $id;


    /**
     * var date $invoice_billingdate
     * @ORM\Column(name="invoice_billingdate",type="datetime")
     */
    protected $invoice_billingdate;
    /**
     * @var integer $id_customer
     * @ORM\Column(name="id_customer",type="integer")
     **/
    protected $id_customer;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=3)
     */
    protected $invoice_detail_price;

    /**
     * @var integer $invoice_detail_quantity
     * @ORM\Column(name="invoice_detail_quantity",type="integer")
     **/
    protected $invoice_detail_quantity;


    /**
     * @var integer $invoice_detail_discount
     * @ORM\Column(name="invoice_detail_discount",type="integer")
     **/
    protected $invoice_detail_discount;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=3)
     */
    protected $invoice_detail_total;

    /**
     * @var integer $id_product
     * @ORM\Column(name="id_product",type="integer")
     **/
    protected $id_product;

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

    /**
     * @return mixed
     */
    public function getInvoiceDetailPrice()
    {
        return $this->invoice_detail_price;
    }

    /**
     * @param mixed $invoice_detail_price
     */
    public function setInvoiceDetailPrice($invoice_detail_price)
    {
        $this->invoice_detail_price = $invoice_detail_price;
    }

    /**
     * @return int
     */
    public function getInvoiceDetailQuantity()
    {
        return $this->invoice_detail_quantity;
    }

    /**
     * @param int $invoice_detail_quantity
     */
    public function setInvoiceDetailQuantity($invoice_detail_quantity)
    {
        $this->invoice_detail_quantity = $invoice_detail_quantity;
    }

    /**
     * @return int
     */
    public function getInvoiceDetailDiscount()
    {
        return $this->invoice_detail_discount;
    }

    /**
     * @param int $invoice_detail_discount
     */
    public function setInvoiceDetailDiscount($invoice_detail_discount)
    {
        $this->invoice_detail_discount = $invoice_detail_discount;
    }

    /**
     * @return mixed
     */
    public function getInvoiceDetailTotal()
    {
        return $this->invoice_detail_total;
    }

    /**
     * @param mixed $invoice_detail_total
     */
    public function setInvoiceDetailTotal($invoice_detail_total)
    {
        $this->invoice_detail_total = $invoice_detail_total;
    }

    /**
     * @return int
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param int $id_product
     */
    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }

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


}