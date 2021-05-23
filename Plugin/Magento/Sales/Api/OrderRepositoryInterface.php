<?php

namespace QT\CustomSalesOrder\Plugin\Magento\Sales\Api;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\ResourceModel\Order\Collection;
use QT\CustomSalesOrder\Model\CustomSalesOrderRepository;
use QT\CustomSalesOrder\Model\CustomSalesOrderFactory as ObjectModelFactory;

/**
 * Class OrderRepositoryInterface
 * @package QT\CustomSalesOrder\Plugin\Magento\Sales\Api
 */
class OrderRepositoryInterface
{
    /**
     * @var OrderExtensionFactory
     */
    private $orderExtensionFactory;

    /**
     * @var CustomSalesOrderRepository
     */
    private $customSalesOrderRepository;

    /**
     * @var ObjectModelFactory
     */
    private $objectModelFactory;

    /**
     * OrderRepositoryInterface constructor.
     * @param OrderExtensionFactory $orderExtensionFactory
     * @param CustomSalesOrderRepository $customSalesOrderRepository
     * @param ObjectModelFactory $objectModelFactory
     */
    public function __construct(
        OrderExtensionFactory $orderExtensionFactory,
        CustomSalesOrderRepository $customSalesOrderRepository,
        ObjectModelFactory $objectModelFactory

    ) {
        $this->orderExtensionFactory = $orderExtensionFactory;
        $this->customSalesOrderRepository = $customSalesOrderRepository;
        $this->objectModelFactory = $objectModelFactory;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        OrderInterface $order
    ) {
        /** @var \Magento\Sales\Api\Data\OrderExtension $orderExtension */
        $orderExtension = $order->getExtensionAttributes() ?? $this->orderExtensionFactory->create();

        $customSalesOrder = $this->customSalesOrderRepository->getByOrderId($order->getEntityId());
        if ($customSalesOrder) {
            $orderExtension->setSalesChannel($customSalesOrder->getSalesChannel());
            $orderExtension->setSupplier($customSalesOrder->getSupplier());
            $orderExtension->setCskhComment($customSalesOrder->getCskhComment());
            $orderExtension->setIntegrationId($customSalesOrder->getIntegrationId());
            $orderExtension->setCustomSalesOrderId($customSalesOrder->getEntityId());
        }

        $order->setExtensionAttributes($orderExtension);
        return $order;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param Collection $result
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetList(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        Collection $result
    ) {
        foreach ($result->getItems() as $order) {
            $this->afterGet($subject, $order);
        }
        return $result;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        OrderInterface $order
    ) {

        $integrationId = $order->getExtensionAttributes()->getIntegrationId();
        $salesChannel = $order->getExtensionAttributes()->getSalesChannel();
        $cskhComment = $order->getExtensionAttributes()->getCskhComment();
        $supplier = $order->getExtensionAttributes()->getSupplier();
        $orderId = $order->getEntityId();

        if ($orderId) {
            /** @var \QT\CustomSalesOrder\Model\CustomSalesOrder $customSalesOrder */
            $customSalesOrder = $this->objectModelFactory->create();

            $customSalesOrder= $this->customSalesOrderRepository->getByOrderId($orderId);
            if ($this->customSalesOrderRepository->getByOrderId($orderId)) {
                $customSalesOrder->setEntityId($customSalesOrder->getEntityId());
            }

            $customSalesOrder->setOrderId($orderId);
            $customSalesOrder->setIntegrationId($integrationId);
            $customSalesOrder->setSalesChannel($salesChannel);
            $customSalesOrder->setCskhComment($cskhComment);
            $customSalesOrder->setSupplier($supplier);

            $this->customSalesOrderRepository->save($customSalesOrder);
        }

        return $order;
    }
}
