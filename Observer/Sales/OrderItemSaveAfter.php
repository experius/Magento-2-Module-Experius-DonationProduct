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

namespace Experius\DonationProduct\Observer\Sales;

use Experius\DonationProduct\Model\DonationsFactory;
use Experius\DonationProduct\Model\Product\Type\Donation;
use Experius\DonationProduct\Model\DonationsRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;

/**
 * Class OrderItemSaveAfter
 * @package Experius\DonationProduct\Observer\Sales
 */
class OrderItemSaveAfter implements ObserverInterface
{
    /**
     * @var DonationsFactory
     */
    private $donationsModel;

    /**
     * @var DonationsRepository
     */
    private $donationsRepository;

    /**
     * @var Order
     */
    private $order;

    /**
     * OrderPlaceAfter constructor.
     * @param DonationsFactory $donations
     * @param DonationsRepository $donationsRepository
     * @param Order $order
     * @internal param DonationsRepository $donations
     */
    public function __construct(
        DonationsFactory $donations,
        DonationsRepository $donationsRepository,
        Order $order
    ) {
        $this->donationsModel = $donations;
        $this->donationsRepository = $donationsRepository;
        $this->order = $order;
    }
    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer
    ) {
        /** @var Order $order */
        $event = $observer->getEvent();
        /** @var \Magento\Sales\Model\Order\Item $orderItem */
        $orderItem = $event->getItem();

        if ($orderItem->getProductType() != Donation::TYPE_CODE) {
            return;
        }

        /** @var \Experius\DonationProduct\Model\Donations $donation */
        $donation = $this->donationsModel->create()->load($orderItem->getItemId(), 'order_item_id');
        if ($donation->getId()) {
            if ($orderItem->getQtyOrdered()==$orderItem->getQtyInvoiced()) {
                $donation->setInvoiced(1);
                $donation->save();
            }
            return;
        }

        $orderId = $orderItem->getOrderId();
        $order = $this->order->load($orderId);

        $donation->setName($orderItem->getName());
        $donation->setSku($orderItem->getSku());
        $donation->setAmount($orderItem->getPrice());
        $donation->setOrderId($orderId);
        $donation->setOrderItemId($orderItem->getItemId());
        $donation->setOrderStatus($order->getStatus());
        $donation->setInvoiced('');
        $donation->setCreatedAt($orderItem->getCreatedAt());
        $donation->save();
    }
}
