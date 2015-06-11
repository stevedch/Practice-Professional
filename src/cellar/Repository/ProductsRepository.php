<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 08-06-2015
 * Time: 5:53
 */

namespace cellar\Repository;


use cellar\Entity\Product;
use Doctrine\DBAL\Connection;

class ProductsRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     * */

    protected $database;

    public function __construct(Connection $db)
    {
        $this->database = $db;
    }

    public function  save($product)
    {
        /**
         * @var \cellar\Entity\Product $product
         */

        $productData = array
        (
            'product_name' => $product->getProductName(),
            'product_price' => $product->getProductPrice(),
            'product_max_discount' => $product->getProductMaxDiscount(),
            'product_stock_quantity' => $product->getProductStockQuantity(),
            'category_name' => $product->getCategoryName()
        );
        if ($product->getId()) {
            $this->database->update('product', $productData, array('id' => $product->getId()));

        } else {
            $this->database->insert('product', $productData);
            $id = $this->database->lastInsertId();
            $product->setId($id);
        }

        return $product;
    }

    public function getCount()
    {
        return $this->database->fetchColumn('SELECT COUNT(id) FROM product');
    }


    /**
     *Devuelve una entidad que coincida con el id.
     *
     * @param integer $id
     *
     * @return object|false An entity object if found, false otherwise.
     * */
    public function find($id)
    {
        $productscatData = $this->database->fetchAssoc('SELECT * FROM product WHERE id = ?', array($id));
        return $productscatData ? $this->buildProductsCat($productscatData) : FALSE;
    }

    public function findAll($limit, $offset = 1, $orderBy = array())
    {
        if (!$orderBy) {
            $orderBy = array('category_name' => 'ASC');
        }
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('product', 'p')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('p.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $product = $statement->fetchAll();
        $products = array();

        foreach ($product as $productscatData) {
            $productId = $productscatData['id'];
            $products[$productId] = $this->buildProductsCat($productscatData);
        }
        return $products;

    }

    protected function buildProductsCat($productscatData)
    {
        $products = new Product();
        $products->setId($productscatData['id']);
        $products->setProductName($productscatData['product_name']);
        $products->setProductPrice($productscatData['product_price']);
        $products->setProductMaxDiscount($productscatData['product_max_discount']);
        $products->setProductStockQuantity($productscatData['product_stock_quantity']);
        $products->setCategoryName($productscatData['category_name']);
        return $products;
    }

    /**
     *Elimmina las entidades.
     * @param object $id
     * @return int
     */
    public function delete($id)
    {
        return $this->database->delete('product', array('id' => $id));
    }
}