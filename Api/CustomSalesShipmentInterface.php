<?php

declare(strict_types=1);

namespace QT\CustomSalesOrder\Api;

/**
 * Interface CustomSalesShipmentInterfaceInterface
 * @package QT\CustomSalesOrder\Api\Data
 */
interface CustomSalesShipmentInterface
{
    const STATUS_NEW = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_PACKED = 2;
    const STATUS_SEND_HVC = 3;
    const STATUS_DELIVERY = 4;

    /**
     * String constants for property names
     */
    const ENTITY = "entity";
    const ORDER_ID = "order_id";
    const CONTRACT_ID = "contract_id";
    const CITY = "city";
    const DISTRICT = "district";
    const STATUS = "status";
    const CREATED_AT = "created_at";
    const CONFIRMED_AT = "confirmed_at";
    const PACKED_AT = "packed_at";
    const SEND_HVC_AT = "send_hvc_at";
    const DELIVERY_AT = "delivery_at";

    /**
     * Getter for Entity.
     *
     * @return int|null
     */
    public function getEntity(): ?int;

    /**
     * Setter for Entity.
     *
     * @param int|null $entity
     *
     * @return void
     */
    public function setEntity(?int $entity): void;

    /**
     * Getter for OrderId.
     *
     * @return int|null
     */
    public function getOrderId(): ?int;

    /**
     * Setter for OrderId.
     *
     * @param int|null $orderId
     *
     * @return void
     */
    public function setOrderId(?int $orderId): void;

    /**
     * Getter for ContractId.
     *
     * @return int|null
     */
    public function getContractId(): ?int;

    /**
     * Setter for ContractId.
     *
     * @param int|null $contractId
     *
     * @return void
     */
    public function setContractId(?int $contractId): void;

    /**
     * Getter for City.
     *
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * Setter for City.
     *
     * @param string|null $city
     *
     * @return void
     */
    public function setCity(?string $city): void;

    /**
     * Getter for District.
     *
     * @return string|null
     */
    public function getDistrict(): ?string;

    /**
     * Setter for District.
     *
     * @param string|null $district
     *
     * @return void
     */
    public function setDistrict(?string $district): void;

    /**
     * Getter for Status.
     *
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * Setter for Status.
     *
     * @param int|null $status
     *
     * @return void
     */
    public function setStatus(?int $status): void;

    /**
     * Getter for CreatedAt.
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Setter for CreatedAt.
     *
     * @param string|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void;

    /**
     * Getter for ConfirmedAt.
     *
     * @return string|null
     */
    public function getConfirmedAt(): ?string;

    /**
     * Setter for ConfirmedAt.
     *
     * @param string|null $confirmedAt
     *
     * @return void
     */
    public function setConfirmedAt(?string $confirmedAt): void;

    /**
     * Getter for PackedAt.
     *
     * @return string|null
     */
    public function getPackedAt(): ?string;

    /**
     * Setter for PackedAt.
     *
     * @param string|null $packedAt
     *
     * @return void
     */
    public function setPackedAt(?string $packedAt): void;

    /**
     * Getter for SendHvcAt.
     *
     * @return string|null
     */
    public function getSendHvcAt(): ?string;

    /**
     * Setter for SendHvcAt.
     *
     * @param string|null $sendHvcAt
     *
     * @return void
     */
    public function setSendHvcAt(?string $sendHvcAt): void;

    /**
     * Getter for DeliveryAt.
     *
     * @return string|null
     */
    public function getDeliveryAt(): ?string;

    /**
     * Setter for DeliveryAt.
     *
     * @param string|null $deliveryAt
     *
     * @return void
     */
    public function setDeliveryAt(?string $deliveryAt): void;
}
