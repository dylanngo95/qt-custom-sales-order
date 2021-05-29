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
    const DELIVERY_NOTE_ID = "delivery_note_id";
    const SPECIFICATION = "specification";
    const CREATOR = "creator";
    const CS_PERSON = "cs_person";
    const ISSUER = "issuer";
    const SALE_PERSON = "sale_person";
    const PRODUCTS = "products";
    const CS_COMMENT = "cs_comment";
    const SUPPLIER = "supplier";
    const CANCEL_REASON = "cancel_reason";
    const USE_D = "use_d";
    const RECONCILE_STATUS = "reconcile_status";
    const TRANSFER_STATUS = "transfer_status";
    const TOTAL_ADVANCE = "total_advance";
    const TRANSFER_DATE = "transfer_date";
    const TRANSFER_DATE_SHIPMENT = "transfer_date_shipment";

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
     * Getter for IntegrationId.
     *
     * @return int|null
     */
    public function getIntegrationId(): ?int;

    /**
     * Setter for IntegrationId.
     *
     * @param int|null $integrationId
     *
     * @return void
     */
    public function setIntegrationId(?int $integrationId): void;

    /**
     * Getter for SalesChannel.
     *
     * @return string|null
     */
    public function getSalesChannel(): ?string;

    /**
     * Setter for SalesChannel.
     *
     * @param string|null $salesChannel
     *
     * @return void
     */
    public function setSalesChannel(?string $salesChannel): void;

    /**
     * Getter for DeliveryNoteId.
     *
     * @return string|null
     */
    public function getDeliveryNoteId(): ?string;

    /**
     * Setter for DeliveryNoteId.
     *
     * @param string|null $deliveryNoteId
     *
     * @return void
     */
    public function setDeliveryNoteId(?string $deliveryNoteId): void;

    /**
     * Getter for Specification.
     *
     * @return string|null
     */
    public function getSpecification(): ?string;

    /**
     * Setter for Specification.
     *
     * @param string|null $specification
     *
     * @return void
     */
    public function setSpecification(?string $specification): void;

    /**
     * Getter for Creator.
     *
     * @return string|null
     */
    public function getCreator(): ?string;

    /**
     * Setter for Creator.
     *
     * @param string|null $creator
     *
     * @return void
     */
    public function setCreator(?string $creator): void;

    /**
     * Getter for CsPerson.
     *
     * @return string|null
     */
    public function getCsPerson(): ?string;

    /**
     * Setter for CsPerson.
     *
     * @param string|null $csPerson
     *
     * @return void
     */
    public function setCsPerson(?string $csPerson): void;

    /**
     * Getter for Issuer.
     *
     * @return string|null
     */
    public function getIssuer(): ?string;

    /**
     * Setter for Issuer.
     *
     * @param string|null $issuer
     *
     * @return void
     */
    public function setIssuer(?string $issuer): void;

    /**
     * Getter for SalePerson.
     *
     * @return string|null
     */
    public function getSalePerson(): ?string;

    /**
     * Setter for SalePerson.
     *
     * @param string|null $salePerson
     *
     * @return void
     */
    public function setSalePerson(?string $salePerson): void;

    /**
     * Getter for Products.
     *
     * @return string|null
     */
    public function getProducts(): ?string;

    /**
     * Setter for Products.
     *
     * @param string|null $products
     *
     * @return void
     */
    public function setProducts(?string $products): void;

    /**
     * Getter for CsComment.
     *
     * @return string|null
     */
    public function getCsComment(): ?string;

    /**
     * Setter for CsComment.
     *
     * @param string|null $csComment
     *
     * @return void
     */
    public function setCsComment(?string $csComment): void;

    /**
     * Getter for Supplier.
     *
     * @return string|null
     */
    public function getSupplier(): ?string;

    /**
     * Setter for Supplier.
     *
     * @param string|null $supplier
     *
     * @return void
     */
    public function setSupplier(?string $supplier): void;

    /**
     * Getter for CancelReason.
     *
     * @return string|null
     */
    public function getCancelReason(): ?string;

    /**
     * Setter for CancelReason.
     *
     * @param string|null $cancelReason
     *
     * @return void
     */
    public function setCancelReason(?string $cancelReason): void;

    /**
     * Getter for UseD.
     *
     * @return string|null
     */
    public function getUseD(): ?string;

    /**
     * Setter for UseD.
     *
     * @param string|null $useD
     *
     * @return void
     */
    public function setUseD(?string $useD): void;

    /**
     * Getter for ReconcileStatus.
     *
     * @return string|null
     */
    public function getReconcileStatus(): ?string;

    /**
     * Setter for ReconcileStatus.
     *
     * @param string|null $reconcileStatus
     *
     * @return void
     */
    public function setReconcileStatus(?string $reconcileStatus): void;

    /**
     * Getter for TransferStatus.
     *
     * @return string|null
     */
    public function getTransferStatus(): ?string;

    /**
     * Setter for TransferStatus.
     *
     * @param string|null $transferStatus
     *
     * @return void
     */
    public function setTransferStatus(?string $transferStatus): void;

    /**
     * Getter for TotalAdvance.
     *
     * @return float|null
     */
    public function getTotalAdvance(): ?float;

    /**
     * Setter for TotalAdvance.
     *
     * @param float|null $totalAdvance
     *
     * @return void
     */
    public function setTotalAdvance(?float $totalAdvance): void;

    /**
     * Getter for TransferDate.
     *
     * @return string|null
     */
    public function getTransferDate(): ?string;

    /**
     * Setter for TransferDate.
     *
     * @param string|null $transferDate
     *
     * @return void
     */
    public function setTransferDate(?string $transferDate): void;

    /**
     * Getter for TransferDateShipment.
     *
     * @return string|null
     */
    public function getTransferDateShipment(): ?string;

    /**
     * Setter for TransferDateShipment.
     *
     * @param string|null $transferDateShipment
     *
     * @return void
     */
    public function setTransferDateShipment(?string $transferDateShipment): void;
}
