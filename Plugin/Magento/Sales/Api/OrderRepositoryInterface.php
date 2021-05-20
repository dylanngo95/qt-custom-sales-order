<?php

namespace QT\CustomSalesOrder\Plugin\Magento\Sales\Api;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\ResourceModel\Order\Collection;

/**
 * Class OrderRepositoryInterface
 * @package QT\CustomOrderAttribute\Plugin\Magento\Sales\Api
 */
class OrderRepositoryInterface
{
    /**
     * @var OrderExtensionFactory
     */
    private $orderExtensionFactory;

    public function __construct(
        OrderExtensionFactory $orderExtensionFactory
    ) {
        $this->orderExtensionFactory = $orderExtensionFactory;
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
        $orderExtension = $order->getExtensionAttributes() ?: $this->orderExtensionFactory->create();
        $orderExtension->setSalesChannel('aaaaaaa');
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
     */
    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        $order
    ) {
//        $status = $order->getStatus();
//        $statusReason = $order->getExtensionAttributes()->getMomStatusReason();
//
//        if ($this->dataHelper->isStatusAllowed($status, $statusReason)
//            && !$this->deliveryStatusHistoryManagement->exist($order, $status, $statusReason)
//        ) {
//            /** @var OrderDeliveryStatusHistoryInterface $orderDeliveryStatusHistory */
//            $orderDeliveryStatusHistory = $this->orderDeliveryStatusHistoryFactory->create();
//            $orderDeliveryStatusHistory
//                ->setOrderId($order->getEntityId())
//                ->setStatus($status)
//                ->setReason($statusReason);
//
//            try {
//                $this->orderDeliveryStatusHistoryResource->save($orderDeliveryStatusHistory);
//            } catch (Exception $e) {
//                $this->logger->critical($e);
//            }
//        }

        return $order;
    }
}
