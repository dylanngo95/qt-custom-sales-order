<?php

namespace QT\CustomSalesOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CustomSalesOrder
 * @package QT\CustomSalesOrder\Model\ResourceModel
 */
class CustomSalesOrder extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_sales_order_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('custom_sales_order', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
