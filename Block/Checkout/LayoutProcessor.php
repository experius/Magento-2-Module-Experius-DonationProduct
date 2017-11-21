<?php

namespace Experius\DonationProduct\Block\Checkout;

use Experius\DonationProduct\Helper\Data as DonationHelper;
use Experius\DonationProduct\Block\Donation\ListProduct as DonationProducts;

class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{

    private $donationHelper;

    private $donationProducts;

    public function __construct(
        DonationHelper $donationHelper,
        DonationProducts $donationProducts
    ) {
        $this->donationHelper = $donationHelper;
        $this->donationProducts = $donationProducts;
    }

    public function process($result)
    {
        if (!$this->donationHelper->isEnabled()) {
            return $result;
        }

        $result['components']['checkout']['children']['steps']['children']
        ['billing-step']['children']['payment']['children']
        ['afterMethods']['children']['experius-donations'] = $this->getDonationForm('billing');

        return $result;
    }

    public function getDonationForm($scope)
    {
        $donationForm =
            [
                'component' => 'Magento_Ui/js/form/components/html',
                'config' => [
                    'content'=> $this->donationProducts->setTemplate('donation.phtml')->toHtml(),
                    "products" => $this->donationProducts->getProductCollectionArray()
                ]
            ];

        return $donationForm;
    }
}
