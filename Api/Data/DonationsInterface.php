<?php

namespace Experius\DonationProduct\Api\Data;

interface DonationsInterface
{

    const ORDER_STATUS = 'order_status';
    const ORDER_ID = 'order_id';
    const DONATIONS_ID = 'donations_id';
    const NAME = 'name';
    const AMOUNT = 'amount';
    const INVOICED = 'invoiced';
    const SKU = 'sku';
    const CREATED_AT = 'created_at';


    /**
     * Get donations_id
     * @return string|null
     */
    public function getDonationsId();

    /**
     * Set donations_id
     * @param string $donationsId
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setDonationsId($donationsId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setName($name);

    /**
     * Get sku
     * @return string|null
     */
    public function getSku();

    /**
     * Set sku
     * @param string $sku
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setSku($sku);

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     * @param string $amount
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setAmount($amount);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $order_id
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderId($order_id);

    /**
     * Get order_status
     * @return string|null
     */
    public function getOrderStatus();

    /**
     * Set order_status
     * @param string $order_status
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderStatus($order_status);

    /**
     * Get invoiced
     * @return string|null
     */
    public function getInvoiced();

    /**
     * Set invoiced
     * @param string $invoiced
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setInvoiced($invoiced);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setCreatedAt($createdAt);
}
