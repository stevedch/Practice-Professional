<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 05-06-2015
 * Time: 21:27
 */

namespace cellar\Repository;

use cellar\Entity\Provider;
use Doctrine\DBAL\Connection;

class ProviderRepository implements RepositoryInterface
{

    protected $db;

    /**
     * @var  \Doctrine\DBAL\Connection
     * */

    public function __construct(Connection $db)
    {
        $this->database = $db;
    }

    /**
     * Guarda la entidad en la base de datos.
     * @param object $provider
     * @return mixed
     */
    public function save($provider)
    {
        /**
         * @var \cellar\Entity\Provider $provider
         */

        $providerrData = array
        (
            'provider_name' => $provider->getProviderName(),
            'provider_telephone' => $provider->getProviderTelephone(),
            'provider_address' => $provider->getProviderAddress()

        );

        if ($provider->getId()) {
            $this->database->update('provider', $providerrData, array('id' => $provider->getId()));

        } else {
            $this->database->insert('provider', $providerrData);
            // Obtener el ID del usuario recién creado y lo asigna sobre la entidad.
            $id = $this->database->lastInsertId();
            $provider->setId($id);
        }

        return $provider;
    }

    /**
     * retorna el total de entidades que existen en la base de datos.
     *
     * @return int The total number of entities.
     */
    public function getCount()
    {
        return $this->database->fetchColumn('SELECT COUNT(id) FROM provider');
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
        $providerData = $this->database->fetchAssoc('SELECT * FROM provider WHERE id = ?', array($id));
        return $providerData ? $this->buildProvider($providerData) : FALSE;
    }

    /**
     *Elimmina las entidades.
     * @param object $id
     * @return int
     */
    public function delete($id)
    {
        return $this->database->delete('provider', array('id' => $id));
    }


    /**
     * Retorna una collección de entidades.
     *
     * @param integer $limit
     *   El número de entidades para volver.
     * @param integer $offset
     *   El número de entidades para saltar.
     * @param array $orderBy
     *   Opcionalmente, el orden de información, en la $column => $direction format.
     *
     * @return array A collection of entity objects.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        if (!$orderBy) {
            $orderBy = array('id' => 'ASC');
        }
        $queryBuilder = $this->database->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('provider', 'p')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('p.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();

        $providersData = $statement->fetchAll();
        $providers = array();

        foreach ($providersData as $providerData) {
            $providerId = $providerData['id'];
            $providers[$providerId] = $this->buildProvider($providerData);
        }
        return $providers;
    }


    /**
     * Ejemplariza una entidad usuario, establece sus propiedades utilizando datos db.
     * @param array $providerData The array of db data.
     * @return \cellar\Entity\Provider $provider
     */
    protected function buildProvider($providerData)
    {
        $provider = new Provider();

        $provider->setId($providerData['id']);
        $provider->setProviderName($providerData['provider_name']);
        $provider->setProviderTelephone($providerData['provider_telephone']);
        $provider->setProviderAddress($providerData['provider_address']);

        return $provider;

    }
}