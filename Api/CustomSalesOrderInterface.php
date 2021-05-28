<?php

declare(strict_types=1);

namespace QT\CustomSalesOrder\Api;

/**
 * Interface CustomSalesOrderInterface
 * @package QT\CustomSalesOrder\Api
 */
interface CustomSalesOrderInterface
{
    /**
     * String constants for property names
     */
    const ENTITY_ID = "entity_id";
    const ORDER_ID = "order_id";
    const INTEGRATION_ID = "integration_id";
    const SALES_CHANNEL = "sales_channel";
    const CSKH_COMMENT = "cskh_comment";
    const SUPPLIER = "supplier";

    /**
     * Getter for EntityId.
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Setter for EntityId.
     *
     * @param int|null $entityId
     *
     * @return void
     */
    public function setEntityId($entityId);

    /**
     * Getter for OrderId.
     *
     * @return int|null
     */
    public function getOrderId();

    /**
     * Setter for OrderId.
     *
     * @param int|null $orderId
     *
     * @return void
     */
    public function setOrderId($orderId);

    /**
     * Getter for IntegrationId.
     *
     * @return int|null
     */
    public function getIntegrationId();

    /**
     * Setter for IntegrationId.
     *
     * @param int|null $integrationId
     *
     * @return void
     */
    public function setIntegrationId($integrationId);

    /**
     * Getter for SalesChannel.
     *
     * @return string|null
     */
    public function getSalesChannel();

    /**
     * Setter for SalesChannel.
     *
     * @param string|null $salesChannel
     *
     * @return void
     */
    public function setSalesChannel($salesChannel);

    /**
     * Getter for CskhComment.
     *
     * @return string|null
     */
    public function getCskhComment();

    /**
     * Setter for CskhComment.
     *
     * @param string|null $cskhComment
     *
     * @return void
     */
    public function setCskhComment($cskhComment);

    /**
     * Getter for Supplier.
     *
     * @return string|null
     */
    public function getSupplier();

    /**
     * Setter for Supplier.
     *
     * @param string|null $supplier
     *
     * @return void
     */
    public function setSupplier($supplier);
}
