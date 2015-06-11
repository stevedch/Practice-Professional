<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 03-06-2015
 * Time: 23:59
 */

namespace cellar\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

class Purchase
{

    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer")
     **/

    protected $id;

    /**
     * @var integer $id_provider
     * @ORM\Column(name="id_provider",type="integer",nullable="false")
     **/
    protected $id_provider;

    /**
     * @var integer $id_product
     * @ORM\Column(name="id_product",type="integer",nullable="false")
     **/
    protected $id_product;


    /**
     * var date $purchase_billingdate
     * @ORM\Column(name="purchase_billingdate",type="datetime")
     */
    protected $purchase_billingdate;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=3)
     */
    protected $purchase_detail_unit_value;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=3)
     */
    protected $purchase_detail_price;

    /**
     * @var integer $purchase_detail_quantity
     * @ORM\Column(name="purchase_detail_quantity",type="integer")
     **/
    protected $purchase_detail_quantity;
    /**
     * @var integer $purchase_detail_iva
     * @ORM\Column(name="purchase_detail_iva",type="integer")
     **/
    protected $purchase_detail_iva;
    /**
     * @var integer $purchase_detail_discount
     * @ORM\Column(name="purchase_detail_discount",type="integer")
     **/
    protected $purchase_detail_discount;
    /**
     * @ORM\Column(type="decimal", precision=19, scale=3)
     */
    protected $purchase_detail_value_total;

    /**
     * @return int
     */
    public function getIdProvider()
    {
        return $this->id_provider;
    }

    /**
     * @param int $id_provider
     */
    public function setIdProvider($id_provider)
    {
        $this->id_provider = $id_provider;
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
     * @return mixed
     */
    public function getPurchaseDetailUnitValue()
    {
        return $this->purchase_detail_unit_value;
    }

    /**
     * @param mixed $purchase_detail_unit_value
     */
    public function setPurchaseDetailUnitValue($purchase_detail_unit_value)
    {
        $this->purchase_detail_unit_value = $purchase_detail_unit_value;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDetailPrice()
    {
        return $this->purchase_detail_price;
    }

    /**
     * @param mixed $purchase_detail_price
     */
    public function setPurchaseDetailPrice($purchase_detail_price)
    {
        $this->purchase_detail_price = $purchase_detail_price;
    }

    /**
     * @return int
     */
    public function getPurchaseDetailQuantity()
    {
        return $this->purchase_detail_quantity;
    }

    /**
     * @param int $purchase_detail_quantity
     */
    public function setPurchaseDetailQuantity($purchase_detail_quantity)
    {
        $this->purchase_detail_quantity = $purchase_detail_quantity;
    }

    /**
     * @return int
     */
    public function getPurchaseDetailIva()
    {
        return $this->purchase_detail_iva;
    }

    /**
     * @param int $purchase_detail_iva
     */
    public function setPurchaseDetailIva($purchase_detail_iva)
    {
        $this->purchase_detail_iva = $purchase_detail_iva;
    }

    /**
     * @return int
     */
    public function getPurchaseDetailDiscount()
    {
        return $this->purchase_detail_discount;
    }

    /**
     * @param int $purchase_detail_discount
     */
    public function setPurchaseDetailDiscount($purchase_detail_discount)
    {
        $this->purchase_detail_discount = $purchase_detail_discount;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDetailValueTotal()
    {
        return $this->purchase_detail_value_total;
    }

    /**
     * @param mixed $purchase_detail_value_total
     */
    public function setPurchaseDetailValueTotal($purchase_detail_value_total)
    {
        $this->purchase_detail_value_total = $purchase_detail_value_total;
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
    public function getPurchaseBillingdate()
    {
        return $this->purchase_billingdate;
    }

    /**
     * @param DateTime|\DateTime $purchase_billingdate
     */
    public function setPurchaseBillingdate(\DateTime $purchase_billingdate)
    {
        $this->purchase_billingdate = $purchase_billingdate;
    }



}