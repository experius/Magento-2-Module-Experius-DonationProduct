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

use Experius\DonationProduct\Model\Donations;
use Experius\DonationProduct\Model\Product\Type\Donation;
use Experius\DonationProduct\Model\DonationsRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class OrderSaveAfter
 * @package Experius\DonationProduct\Observer\Sales
 */
class OrderSaveAfter implements ObserverInterface
{
    /**
     * @var Donations
     */
    private $donationsModel;

    /**
     * @var DonationsRepository
     */
    private $donationsRepository;

    /**
     * OrderPlaceAfter constructor.
     * @param Donations $donations
     * @param DonationsRepository $donationsRepository
     * @internal param DonationsRepository $donations
     */
    public function __construct(
        Donations $donations,
        DonationsRepository $donationsRepository
    ) {
        $this->donationsModel = $donations;
        $this->donationsRepository = $donationsRepository;
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
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getOrder();
        $orderId = $order->getId();

        /** @var \Experius\DonationProduct\Model\Donations $donations */
        $donations = $this->donationsRepository->getDonationsByOrderId($orderId);

        foreach ($donations as $donationItem) {
            $this->updateDonationItemData($donationItem, $order->getStatus());
        }
    }

    /**
     * @param $donationItem
     * @param $orderStatus
     */
    private function updateDonationItemData($donationItem, $orderStatus)
    {
        /** @var \Experius\DonationProduct\Model\Donations $donationItem */
        $donationItem->setOrderStatus($orderStatus);
        $donationItem->save();
    }
}
