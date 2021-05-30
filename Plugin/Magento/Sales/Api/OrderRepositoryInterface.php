<?php

declare(strict_types=1);

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
     */
    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        OrderInterface $order
    ) {
        /** @var \Magento\Sales\Api\Data\OrderExtension $orderExtension */
        $orderExtension = $order->getExtensionAttributes() ?? $this->orderExtensionFactory->create();
        $orderId = (int) $order->getEntityId();

        $customSalesOrder = $this->customSalesOrderRepository->getByOrderId($orderId);
        if ($customSalesOrder) {
            $orderExtension->setCustomSalesOrderId($customSalesOrder->getEntityId());
            $orderExtension->setSalesChannel($customSalesOrder->getSalesChannel());
            $orderExtension->setSupplier($customSalesOrder->getSupplier());
            $orderExtension->setCsComment($customSalesOrder->getCsComment());
            $orderExtension->setIntegrationId($customSalesOrder->getIntegrationId());
            $orderExtension->setDeliveryNoteId($customSalesOrder->getDeliveryNoteId());
            $orderExtension->setSpecification($customSalesOrder->getSpecification());
            $orderExtension->setCreator($customSalesOrder->getCreator());
            $orderExtension->setCsPerson($customSalesOrder->getCsPerson());
            $orderExtension->setIssuer($customSalesOrder->getIssuer());
            $orderExtension->setSalePerson($customSalesOrder->getSalePerson());
            $orderExtension->setProducts($customSalesOrder->getProducts());
            $orderExtension->setCancelReason($customSalesOrder->getCancelReason());
            $orderExtension->setUseD($customSalesOrder->getUseD());
            $orderExtension->setReconcileStatus($customSalesOrder->getReconcileStatus());
            $orderExtension->setTransferStatus($customSalesOrder->getTransferStatus());
            $orderExtension->setTotalAdvance($customSalesOrder->getTotalAdvance());
            $orderExtension->setTransferDate($customSalesOrder->getTransferDate());
            $orderExtension->setTransferDateShipment($customSalesOrder->getTransferDateShipment());
        }
        $customSalesShipment = $this->customSalesShipmentRepository->getByOrderId($orderId);
        if ($customSalesShipment) {
            $orderExtension->setCustomSalesShipmentId($customSalesShipment->getEntityId());
            $orderExtension->setShipmentStatus($customSalesShipment->getStatus());
            $orderExtension->setContractId($customSalesShipment->getContractId());
            $orderExtension->setCity($customSalesShipment->getCity());
            $orderExtension->setDistrict($customSalesShipment->getDistrict());
            $orderExtension->setStreet($customSalesShipment->getStreet());
            $orderExtension->setCreatedAt($customSalesShipment->getCreatedAt());
            $orderExtension->setConfirmedAt($customSalesShipment->getConfirmedAt());
            $orderExtension->setPackedAt($customSalesShipment->getPackedAt());
            $orderExtension->setSendHvcAt($customSalesShipment->getSendHvcAt());
            $orderExtension->setDeliveryAt($customSalesShipment->getDeliveryAt());
        }

        $order->setExtensionAttributes($orderExtension);
        return $order;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param Collection $result
     * @return Collection
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
     * @throws \Magento\Framework\Exception\AlreadyExistsException|\Magento\Framework\Webapi\Exception
     */
    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        OrderInterface $order
    ) {

        /** @var \Magento\Sales\Api\Data\OrderExtensionInterface $orderExtension */
        $orderExtension = $order->getExtensionAttributes() ?? $this->orderExtensionFactory->create();
        $orderId = (int) $order->getEntityId();

        if ($orderId) {
            /** @var \QT\CustomSalesOrder\Model\CustomSalesOrder $customSalesOrder */
            $customSalesOrder = $this->objectModelFactory->create();

            $customSalesOrderOld = $this->customSalesOrderRepository->getByOrderId($orderId);
            if ($customSalesOrderOld) {
                $customSalesOrder->setEntityId($customSalesOrderOld->getEntityId());
            }

            $customSalesOrder->setOrderId($orderId);
            $customSalesOrder->setIntegrationId($orderExtension->getIntegrationId());
            $customSalesOrder->setSalesChannel($orderExtension->getSalesChannel());
            $customSalesOrder->setCsComment($orderExtension->getCsComment());
            $customSalesOrder->setSupplier($orderExtension->getSupplier());
            $customSalesOrder->setDeliveryNoteId($orderExtension->getDeliveryNoteId());
            $customSalesOrder->setSpecification($orderExtension->getSpecification());
            $customSalesOrder->setCreator($orderExtension->getCreator());
            $customSalesOrder->setCsPerson($orderExtension->getCsPerson());
            $customSalesOrder->setIssuer($orderExtension->getIssuer());
            $customSalesOrder->setSalePerson($orderExtension->getSalePerson());
            $customSalesOrder->setProducts($orderExtension->getProducts());
            $customSalesOrder->setCancelReason($orderExtension->getCancelReason());
            $customSalesOrder->setUseD($orderExtension->getUseD());
            $customSalesOrder->setReconcileStatus($orderExtension->getReconcileStatus());
            $customSalesOrder->setTransferStatus($orderExtension->getTransferStatus());
            $customSalesOrder->setTotalAdvance($orderExtension->getTotalAdvance());
            $customSalesOrder->setTransferDate($orderExtension->getTransferDate());
            $customSalesOrder->setTransferDateShipment($orderExtension->getTransferDateShipment());

            $this->customSalesOrderRepository->save($customSalesOrder);
        }

        return $order;
    }
}
