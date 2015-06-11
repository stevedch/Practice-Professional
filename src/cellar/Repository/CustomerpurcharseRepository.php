<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 15:02
 */

namespace cellar\Repository;

use Doctrine\DBAL\Connection;

class CustomerpurcharseRepository
{

    /**
     * @var \Doctrine\DBAL\Connection
     * */

    protected $database;

    public function __construct(Connection $db)
    {
        $this->database = $db;
    }

    public function  save($customer)
    {
        /**
         * @var \cellar\Entity\CustomerPurchase $customer
         */

        $customerData = array
        (
            'invoice_detail_price' => $customer->getInvoiceDetailPrice(),
            'invoice_detail_quantity' => $customer->getInvoiceDetailQuantity(),
            'invoice_detail_discount' => $customer->getInvoiceDetailDiscount(),
            'invoice_detail_total' => $customer->getInvoiceDetailTotal(),
            'id_customer' => $customer->getIdCustomer(),
            'id_product' => $customer->getIdProduct()
        );


        if ($customer->getId()) {
            $this->database->update('invoice_detail', $customerData, array('id' => $customer->getId()));

        } else {
            $this->database->insert('invoice_detail', $customerData);
            $id = $this->database->lastInsertId();
            $customer->setId($id);
        }

        return $customer;
    }


}