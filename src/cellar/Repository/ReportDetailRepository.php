<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 07-06-2015
 * Time: 15:47
 */

namespace cellar\Repository;


use cellar\Entity\Customer;
use cellar\Entity\CustomerPurchase;
use cellar\Entity\Invoice;
use cellar\Entity\Product;
use Doctrine\DBAL\Connection;

class ReportDetailRepository
{
    /**
     * @var \Doctrine\DBAL\Connection $database
     * **/
    protected $database;

    public function __construct(Connection $db)
    {
        $this->database = $db;
    }


    public function getCount()
    {
        return $this->database->fetchColumn('SELECT COUNT(id) FROM invoice_detail');
    }


    /**
     * Devuelve una colección de usuarios.
     * @param integer $limit
     *   El número de usuarios para volver.
     * @param integer $offset
     *   El número de usuarios para saltar.
     * @param array $orderBy
     *   Opcionalmente, el orden de información, en el $column => $direction format.
     * @return array A collection of users, keyed by user id.
     */
    public function findAll($limit, $offset = 1, $orderBy = array())
    {
        if (!$orderBy) {
            $orderBy = array('invoice_billingdate' => 'ASC');
        }
        //SELECT *  FROM customer as c INNER JOIN invoice_detail i_d ON i_d.id_customer = c.id INNER JOIN product as pr ON i_d.id_product = pr.id
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('c.*, pr.*, i_d.*')
            ->from('customer', 'c')
            ->innerJoin('c', 'invoice_detail', 'i_d', 'i_d.id_customer = c.id')
            ->innerJoin('i_d', 'product', 'pr', 'pr.id = i_d.id_product')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('i_d.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $customersData = $statement->fetchAll();
        $invoice_details = array();

        foreach ($customersData as $reportCustomerData) {
            $invoice_detailsId = $reportCustomerData['id'];
            $invoice_details[$invoice_detailsId] = $this->builderReportCustomer($reportCustomerData);
        }
        return $invoice_details;


    }

    protected function builderReportCustomer($reportCustomerData)
    {
        //Entity Customer
        $reportCustomer = new Customer();
        $reportCustomer->setCustomerRut($reportCustomerData['customer_rut']);
        $reportCustomer->setCustomerName($reportCustomerData['customer_name']);
        $reportCustomer->setCustomerLastname($reportCustomerData['customer_lastname']);
        $reportCustomer->setCustomerMotherslastname($reportCustomerData['customer_motherslastname']);
        //Entity Invoice
        $reportInvoice = new  Invoice();
        $billingdate = new \DateTime($reportCustomerData['invoice_billingdate']);
        $reportInvoice->setInvoiceBillingdate($billingdate);
        //Entity Invoice_Details
        $reportPurchase = new CustomerPurchase();
        //@TODO revisar id
        $reportPurchase->setId($reportCustomerData['id']);
        $reportPurchase->setInvoiceDetailPrice($reportCustomerData['invoice_detail_price']);
        $reportPurchase->setInvoiceDetailQuantity($reportCustomerData['invoice_detail_quantity']);
        $reportPurchase->setInvoiceDetailDiscount($reportCustomerData['invoice_detail_discount']);
        $reportPurchase->setInvoiceDetailTotal($reportCustomerData['invoice_detail_total']);
        //Entity Product
        $reportProduct = new Product();
        $reportProduct->setProductName($reportCustomerData['product_name']);

        return array(
            $reportCustomer,
            $reportInvoice,
            $reportPurchase,
            $reportProduct
        );

    }
}