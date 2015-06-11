<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 03-06-2015
 * Time: 22:01
 */

namespace cellar\Repository;

use cellar\Entity\Product;
use cellar\Entity\Purchase;
use Doctrine\DBAL\Connection;

class PurchaseRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     * */

    protected $database;

    public function __construct(Connection $db)
    {
        $this->database = $db;
    }

//@TODO Procedure Purchase products

    public function  save($purchase)
    {
        /**
         * @var \cellar\Entity\Purchase $purchase
         */

        $purchaseData = array
        (
            'purchase_detail_unit_value' => $purchase->getPurchaseDetailUnitValue(),
            'purchase_detail_price' => $purchase->getPurchaseDetailPrice(),
            'purchase_detail_quantity' => $purchase->getPurchaseDetailQuantity(),
            'purchase_detail_iva' => $purchase->getPurchaseDetailIva(),
            'purchase_detail_discount' => $purchase->getPurchaseDetailDiscount(),
            'purchase_detail_value_total' => $purchase->getPurchaseDetailValueTotal(),
            'id_provider' => $purchase->getIdProvider(),
            'id_product' => $purchase->getIdProduct()
        );


        if ($purchase->getId()) {
            $this->database->update('purchase_detail', $purchaseData, array('id' => $purchase->getId()));

        } else {
            $this->database->insert('purchase_detail', $purchaseData);
            $id = $this->database->lastInsertId();
            $purchase->setId($id);
        }

        return $purchase;
    }


    protected function buildershopping($providerData)
    {
        $shopping = new Purchase();

        $shopping->setProductName($providerData['product_name']);
        $shopping->setProductPrice($providerData['product_price']);
        $shopping->setShoppingUnitValue($providerData['shopping_unit_value']);
        $shopping->setShoppingIva($providerData['shopping_iva']);
        $shopping->setShoppingGrossValue($providerData['shopping_gross_value']);
        $shopping->setShoppingDiscount($providerData['shopping_discount']);
        $shopping->setShoppingQuantity($providerData['shopping_quantity']);
        return $shopping;
    }


    public function find($id)
    {
        $userData = $this->database->fetchAssoc('SELECT * FROM product WHERE id = ?', array($id));
        return $userData ? $this->builderProduct($userData) : FALSE;
    }


    public function getCount()
    {
        return $this->database->fetchColumn('SELECT COUNT(id) FROM product');
    }


    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


    //@TODO CAMBIAR DE REPOSITORIO
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        if (!$orderBy) {
            $orderBy = array('id' => 'ASC');
        }
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('product', 'p')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('p.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();

        $productsData = $statement->fetchAll();
        $product = array();

        foreach ($productsData as $productData) {
            $productId = $productData['id'];
            $product[$productId] = $this->builderProduct($productData);
        }

        return $product;
    }


    //Data products
    protected function builderProduct($productData)
    {
        $product = new Product();

        $product->setId($productData['id']);
        $product->setProductName($productData['product_name']);
        $product->setCategoryName($productData['category_name']);
        $product->setProductPrice($productData['product_price']);
        $product->setProductMaxDiscount($productData['product_max_discount']);
        $product->setProductStockQuantity($productData['product_stock_quantity']);

        return $product;
    }
}