<?php

declare(strict_types=1);

namespace QT\CustomSalesOrder\Plugin\Magento\Sales\Model;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderExtensionInterface;
use Magento\Sales\Api\Data\ShipmentInterface;
use QT\CustomSalesOrder\Api\CustomSalesShipmentInterface;
use QT\CustomSalesOrder\Model\CustomSalesShipment;
use QT\CustomSalesOrder\Model\CustomSalesShipmentFactory;
use QT\CustomSalesOrder\Model\CustomSalesShipmentRepository;

/**
 * Class ShipmentRepository
 * @package QT\CustomSalesOrder\Plugin\Magento\Sales\Model
 */
class ShipmentRepository
{
    /**
     * @var OrderExtensionFactory
     */
    private OrderExtensionFactory $orderExtensionFactory;

    /**
     * @var CustomSalesShipmentRepository
     */
    private CustomSalesShipmentRepository $customSalesShipmentRepository;

    /**
     * @var CustomSalesShipmentFactory
     */
    private CustomSalesShipmentFactory $customSalesShipmentFactory;

    public function __construct(
        OrderExtensionFactory $orderExtensionFactory,
        CustomSalesShipmentRepository $customSalesShipmentRepository,
        CustomSalesShipmentFactory $customSalesShipmentFactory
    ) {
        $this->orderExtensionFactory = $orderExtensionFactory;
        $this->customSalesShipmentRepository = $customSalesShipmentRepository;
        $this->customSalesShipmentFactory = $customSalesShipmentFactory;
    }

    /**
     * @param \Magento\Sales\Model\Order\ShipmentRepository $subject
     * @param $result
     * @param ShipmentInterface $entity
     * @return mixed
     * @throws \Magento\Framework\Webapi\Exception
     */
    public function afterSave(\Magento\Sales\Model\Order\ShipmentRepository $subject, $result, ShipmentInterface $entity)
    {
        $order = $result->getOrder();
        if (!$order) {
            return $result;
        }
        $orderId = (int) $order->getEntityId();
        /** @var OrderExtensionInterface $extensionAttributes */
        $extensionAttributes = $order->getExtensionAttributes() ?? $this->orderExtensionFactory->create();
        $shippingAssignments = $extensionAttributes->getShippingAssignments();
        if (!count($shippingAssignments)) {
            return $result;
        }
        /** @var \Magento\Sales\Api\Data\ShippingAssignmentInterface $shippingAssignment */
        $shippingAssignment = $shippingAssignments[array_key_first($shippingAssignments)];
        /** @var \Magento\Sales\Api\Data\OrderAddressInterface $shippingAddress */
        $shippingAddress = $shippingAssignment->getShipping()->getAddress();

        /** @var CustomSalesShipment $customSalesShipment */
        $customSalesShipment = $this->customSalesShipmentFactory->create();

        $customSalesShipmentOld = $this->customSalesShipmentRepository->getByOrderId($orderId);
        if ($customSalesShipmentOld) {
            $customSalesShipment->setEntity($customSalesShipmentOld->getEntity());
        }

        $customSalesShipment->setOrderId($orderId);
        $customSalesShipment->setCity($shippingAddress->getCity());
        $customSalesShipment->setStreet(implode(",", $shippingAddress->getStreet()));
        $customSalesShipment->setStatus(CustomSalesShipmentInterface::STATUS_NEW);
        $this->customSalesShipmentRepository->save($customSalesShipment);

        return $result;
    }
}
