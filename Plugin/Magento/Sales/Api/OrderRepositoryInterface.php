<?php

namespace QT\CustomSalesOrder\Plugin\Magento\Sales\Api;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\ResourceModel\Order\Collection;
use QT\CustomSalesOrder\Model\CustomSalesOrderRepository;
use QT\CustomSalesOrder\Model\CustomSalesOrderFactory as ObjectModelFactory;
use QT\CustomSalesOrder\Model\CustomSalesShipmentRepository;

/**
 * Class OrderRepositoryInterface
 * @package QT\CustomSalesOrder\Plugin\Magento\Sales\Api
 */
class OrderRepositoryInterface
{
    /**
     * @var OrderExtensionFactory
     */
    private OrderExtensionFactory $orderExtensionFactory;

    /**
     * @var CustomSalesOrderRepository
     */
    private CustomSalesOrderRepository $customSalesOrderRepository;

    /**
     * @var ObjectModelFactory
     */
    private ObjectModelFactory $objectModelFactory;

    /**
     * @var CustomSalesShipmentRepository
     */
    private CustomSalesShipmentRepository $customSalesShipmentRepository;

    /**
     * OrderRepositoryInterface constructor.
     * @param OrderExtensionFactory $orderExtensionFactory
     * @param ObjectModelFactory $objectModelFactory
     * @param CustomSalesOrderRepository $customSalesOrderRepository
     * @param CustomSalesShipmentRepository $customSalesShipmentRepository
     */
    public function __construct(
        OrderExtensionFactory $orderExtensionFactory,
        ObjectModelFactory $objectModelFactory,
        CustomSalesOrderRepository $customSalesOrderRepository,
        CustomSalesShipmentRepository $customSalesShipmentRepository

    ) {
        $this->orderExtensionFactory = $orderExtensionFactory;
        $this->objectModelFactory = $objectModelFactory;
        $this->customSalesOrderRepository = $customSalesOrderRepository;
        $this->customSalesShipmentRepository = $customSalesShipmentRepository;
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
        $customSalesShipment = $this->customSalesShipmentRepository->getByOrderId($order->getEntityId());
        if ($customSalesShipment) {
            $orderExtension->setCustomSalesShipmentId($customSalesShipment->getEntityId());
            $orderExtension->setShipmentStatus($customSalesShipment->getStatus());
            $orderExtension->setContractId($customSalesShipment->getContractId());
            $orderExtension->setCity($customSalesShipment->getCity());
            $orderExtension->setDistrict($customSalesShipment->getDistrict());
            $orderExtension->setDistrict($customSalesShipment->getDistrict());
            $orderExtension->setStreet($customSalesShipment->getStreet());
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
        $orderId = (int) $order->getEntityId();

        if ($orderId) {
            /** @var \QT\CustomSalesOrder\Model\CustomSalesOrder $customSalesOrder */
            $customSalesOrder = $this->objectModelFactory->create();

            $customSalesOrderOld = $this->customSalesOrderRepository->getByOrderId($orderId);
            if ($customSalesOrderOld) {
                $customSalesOrder->setEntityId($customSalesOrderOld->getEntityId());
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
