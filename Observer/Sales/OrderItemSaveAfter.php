<?php

namespace Experius\DonationProduct\Observer\Sales;

use Experius\DonationProduct\Model\DonationsFactory;
use Experius\DonationProduct\Model\Product\Type\Donation;
use Experius\DonationProduct\Model\DonationsRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;

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
        $donation = $this->donationsModel->create();
        $model = $donation->load($orderItem->getItemId(), 'order_item_id');
        if ($model->getId()) {
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
