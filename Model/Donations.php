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

namespace Experius\DonationProduct\Model;

use Experius\DonationProduct\Api\Data\DonationsInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Donations
 * @package Experius\DonationProduct\Model
 */
class Donations extends AbstractModel implements DonationsInterface
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Experius\DonationProduct\Model\ResourceModel\Donations');
    }

    /**
     * Get donations_id
     * @return string
     */
    public function getDonationsId()
    {
        return $this->getData(self::DONATIONS_ID);
    }

    /**
     * Set donations_id
     * @param string $donationsId
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setDonationsId($donationsId)
    {
        return $this->setData(self::DONATIONS_ID, $donationsId);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get sku
     * @return string
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * Set sku
     * @param string $sku
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Get amount
     * @return string
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * Set amount
     * @param string $amount
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * Get order_item_id
     * @return string
     */
    public function getOrderItemId()
    {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    /**
     * Set order_item_id
     * @param string $order_item_id
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderItemId($order_item_id)
    {
        return $this->setData(self::ORDER_ITEM_ID, $order_item_id);
    }

    /**
     * Get order_id
     * @return string
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $order_id
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderId($order_id)
    {
        return $this->setData(self::ORDER_ID, $order_id);
    }

    /**
     * Get order_status
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->getData(self::ORDER_STATUS);
    }

    /**
     * Set order_status
     * @param string $order_status
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderStatus($order_status)
    {
        return $this->setData(self::ORDER_STATUS, $order_status);
    }

    /**
     * Get invoiced
     * @return string
     */
    public function getInvoiced()
    {
        return $this->getData(self::INVOICED);
    }

    /**
     * Set invoiced
     * @param string $invoiced
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setInvoiced($invoiced)
    {
        return $this->setData(self::INVOICED, $invoiced);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
