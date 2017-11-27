<?php
/**
 * A Magento 2 module named Experius/DonationProduct
 * Copyright (C) 2017 Derrick Heesbeen
 *
 * This file is part of Experius/DonationProduct.
 *
 * Experius/DonationProduct is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Experius\DonationProduct\Api\Data;

/**
 * Interface DonationsInterface
 * @package Experius\DonationProduct\Api\Data
 */
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
    const ORDER_ITEM_ID = 'order_item_id';


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
     * Get order_item_id
     * @return string|null
     */
    public function getOrderItemId();

    /**
     * Set order_item_id
     * @param string $order_item_id
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderItemId($order_item_id);

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
