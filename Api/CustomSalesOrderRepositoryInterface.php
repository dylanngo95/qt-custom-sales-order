<?php


namespace QT\CustomSalesOrder\Api;


/**
 * Interface CustomSalesOrderRepositoryInterface
 * @package QT\CustomSalesOrder\Api
 */
interface CustomSalesOrderRepositoryInterface
{
    /**
     * @param CustomSalesOrderInterface $customSalesOrder
     * @return CustomSalesOrderInterface
     */
    public function save(CustomSalesOrderInterface $customSalesOrder);

    /**
     * @param $id
     * @return CustomSalesOrderInterface|null
     */
    public function getById($id);

}
