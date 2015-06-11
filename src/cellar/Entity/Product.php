<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 2:23
 */

namespace cellar\Entity;

use Doctrine\ORM\Mapping as ORM;

class Product
{
    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer",nullable="false")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;
    /**
     * @var string $product_name
     * @ORM\Column(name="product_name",type="string",length="80",nullable="true")
     * */
    protected $product_name;
    /**
     * @ORM\Column(type="decimal", precision=19, scale=3)
     */
    protected $product_price;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected $product_max_discount;

    /**
     * @var integer $product_stock_quantity
     * @ORM\Column(name="product_stock_quantity",type="integer",nullable="false")
     **/
    protected $product_stock_quantity;
    /**
     * @var string $category_name
     * @ORM\Column(name="product_name",type="string",length="80",nullable="true")
     * */
    protected $category_name;

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
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param string $product_name
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * @param mixed $product_price
     */
    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }

    /**
     * @return mixed
     */
    public function getProductMaxDiscount()
    {
        return $this->product_max_discount;
    }

    /**
     * @param mixed $product_max_discount
     */
    public function setProductMaxDiscount($product_max_discount)
    {
        $this->product_max_discount = $product_max_discount;
    }

    /**
     * @return int
     */
    public function getProductStockQuantity()
    {
        return $this->product_stock_quantity;
    }

    /**
     * @param int $product_stock_quantity
     */
    public function setProductStockQuantity($product_stock_quantity)
    {
        $this->product_stock_quantity = $product_stock_quantity;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

}