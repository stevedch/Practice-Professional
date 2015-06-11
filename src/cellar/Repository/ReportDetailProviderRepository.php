<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 07-06-2015
 * Time: 22:58
 */

namespace cellar\Repository;


use cellar\Entity\Product;
use cellar\Entity\Provider;
use cellar\Entity\Purchase;
use cellar\Entity\Shopping;
use Doctrine\DBAL\Connection;

class ReportDetailProviderRepository
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
        return $this->database->fetchColumn('SELECT COUNT(id) FROM purchase_detail');
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
            $orderBy = array('purchase_billingdate' => 'ASC');
        }
//select * from provider as p JOIN purchase_detail as p_d ON p_d.id_provider = p.id JOIN product as pr ON p_d.id_product = pr.id
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('p.* , pr.*, pch.*')
            ->from('provider', 'p')
            ->innerJoin('p', 'purchase_detail', 'pch', 'p.id = pch.id_provider')
            ->innerJoin('pch', 'product', 'pr', 'pr.id = pch.id_product')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('pch.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();
        $invoice_details = array();

        foreach ($usersData as $reportProviderData) {
            $invoice_detailsId = $reportProviderData['id'];
            $invoice_details[$invoice_detailsId] = $this->builderReportProvider($reportProviderData);
        }
        return $invoice_details;


    }

    protected function builderReportProvider($reportProviderData)
    {
        //Entity Provider
        $purchaseProvider = new Provider();
        $purchaseProvider->setProviderName($reportProviderData['provider_name']);
        $purchaseProvider->setProviderTelephone($reportProviderData['provider_telephone']);
        $purchaseProvider->setProviderAddress($reportProviderData['provider_address']);
        //Entity purchase
        $purchase = new Purchase();
        $billingdate = new \DateTime($reportProviderData['purchase_billingdate']);
        $purchase->setPurchaseBillingdate($billingdate);

        //Entity Product
        $pruchaseProduct = new Product();
        $pruchaseProduct->setProductName($reportProviderData['product_name']);

        //Entity Purchase_Details
        $purchaseShopping = new  Purchase();
        $purchaseShopping->setId($reportProviderData['id']);
        $purchaseShopping->setPurchaseDetailUnitValue($reportProviderData['purchase_detail_unit_value']);
        $purchaseShopping->setPurchaseDetailPrice($reportProviderData['purchase_detail_price']);
        $purchaseShopping->setPurchaseDetailQuantity($reportProviderData['purchase_detail_quantity']);
        $purchaseShopping->setPurchaseDetailIva($reportProviderData['purchase_detail_iva']);
        $purchaseShopping->setPurchaseDetailDiscount($reportProviderData['purchase_detail_discount']);
        $purchaseShopping->setPurchaseDetailValueTotal($reportProviderData['purchase_detail_value_total']);


        return array(
            $purchaseProvider,
            $purchase,
            $purchaseShopping,
            $pruchaseProduct
        );
    }

}