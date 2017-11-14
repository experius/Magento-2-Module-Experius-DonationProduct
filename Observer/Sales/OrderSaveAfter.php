<?php

namespace Experius\DonationProduct\Observer\Sales;

use Experius\DonationProduct\Model\Donations;
use Experius\DonationProduct\Model\Product\Type\Donation;
use Experius\DonationProduct\Model\DonationsRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

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
            $donation = $this->donationsModel->load($donationItem->getId());
            $donation->setOrderStatus($order->getStatus());
            $donation->save();
        }
    }
}
