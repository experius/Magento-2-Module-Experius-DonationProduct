<?php


namespace Experius\DonationProduct\Api\Data;

interface DonationsInterface
{

    const ORDER_ID = 'order_id';
    const AMOUNT = 'amount';
    const NAME = 'name';
    const DONATIONS_ID = 'donations_id';
    const SKU = 'sku';


    /**
     * Get donations_id
     * @return string|null
     */
    public function getDonationsId();

    /**
     * Set donations_id
     * @param string $donations_id
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
}
