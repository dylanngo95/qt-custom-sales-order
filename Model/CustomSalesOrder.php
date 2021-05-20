<?php

namespace QT\CustomSalesOrder\Model;

use Magento\Framework\Model\AbstractModel;
use QT\CustomSalesOrder\Api\CustomSalesOrderInterface;
use QT\CustomSalesOrder\Model\ResourceModel\CustomSalesOrder as ResourceModel;

/**
 * Class CustomSalesOrder
 * @package QT\CustomSalesOrder\Model
 */
class CustomSalesOrder extends AbstractModel implements CustomSalesOrderInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_sales_order_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderId($orderId)
    {
        $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @inheritDoc
     */
    public function getIntegrationId()
    {
        return $this->getData(self::INTEGRATION_ID);
    }

    /**
     * @inheritDoc
     */
    public function setIntegrationId($integrationId)
    {
        $this->setData(self::INTEGRATION_ID, $integrationId);
    }

    /**
     * @inheritDoc
     */
    public function getSalesChannel()
    {
        return $this->getData(self::SALES_CHANNEL);
    }

    /**
     * @inheritDoc
     */
    public function setSalesChannel($salesChannel)
    {
        $this->setData(self::SALES_CHANNEL, $salesChannel);
    }

    /**
     * @inheritDoc
     */
    public function getCskhComment()
    {
        return $this->getData(self::CSKH_COMMENT);
    }

    /**
     * @inheritDoc
     */
    public function setCskhComment($cskhComment)
    {
        $this->setData(self::CSKH_COMMENT, $cskhComment);
    }

    /**
     * @inheritDoc
     */
    public function getSupplier()
    {
        return $this->getData(self::SUPPLIER);
    }

    /**
     * @inheritDoc
     */
    public function setSupplier($supplier)
    {
        $this->setData(self::SUPPLIER, $supplier);
    }
}
