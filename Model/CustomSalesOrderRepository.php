<?php


namespace QT\CustomSalesOrder\Model;


use Magento\Framework\Exception\NoSuchEntityException;
use QT\CustomSalesOrder\Api\CustomSalesOrderInterface;
use QT\CustomSalesOrder\Api\CustomSalesOrderRepositoryInterface;
use QT\CustomSalesOrder\Model\ResourceModel\CustomSalesOrder as ObjectResourceModel;
use QT\CustomSalesOrder\Model\CustomSalesOrderFactory as ObjectModelFactory;

/**
 * Class CustomSalesOrderRepository
 * @package QT\CustomSalesOrder\Model
 */
class CustomSalesOrderRepository implements CustomSalesOrderRepositoryInterface
{

    /**
     * @var ObjectResourceModel
     */
    private $objectResourceModel;

    /**
     * @var CustomSalesOrderFactory
     */
    private $objectModelFactory;

    public function __construct(
        ObjectResourceModel $objectResourceModel,
        CustomSalesOrderFactory $objectModelFactory
    )
    {
        $this->objectResourceModel = $objectResourceModel;
        $this->objectModelFactory = $objectModelFactory;
    }

    /**
     * @param CustomSalesOrderInterface $customSalesOrder
     * @return CustomSalesOrderInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(CustomSalesOrderInterface $customSalesOrder)
    {
        return $this->objectResourceModel->save($customSalesOrder);
    }

    /**
     * @param $id
     * @return CustomSalesOrderInterface|null
     */
    public function getById($id)
    {
        $customSalesOrder = $this->objectModelFactory->create();
        $this->objectResourceModel->load($customSalesOrder, $id);
        if (!$customSalesOrder->getEntityId()) {
            return null;
        }
        return $customSalesOrder;
    }
}
