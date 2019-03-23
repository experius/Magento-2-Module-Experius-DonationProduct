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

namespace Experius\DonationProduct\Block\Checkout;

use Experius\DonationProduct\Helper\Data as DonationHelper;
use Experius\DonationProduct\Block\Donation\ListProductFactory as DonationProductsFactory;

/**
 * Class LayoutProcessor
 * @package Experius\DonationProduct\Block\Checkout
 */
class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{

    /**
     * @var DonationHelper
     */
    private $donationHelper;

    /**
     * @var \Experius\DonationProduct\Block\Donation\ListProduct
     */
    private $donationProductsFactory;

    /**
     * LayoutProcessor constructor.
     * @param DonationHelper $donationHelper
     * @param DonationProducts $donationProducts
     */
    public function __construct(
        DonationHelper $donationHelper,
        DonationProductsFactory $donationProductsFactory
    ) {
        $this->donationHelper = $donationHelper;
        $this->donationProductsFactory = $donationProductsFactory;
    }

    /**
     * @param array $result
     * @return array
     */
    public function process($result)
    {

        if ($this->donationHelper->isLayoutCheckoutEnabled() &&
            isset($result['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['afterMethods']['children'])) {
            $result['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['afterMethods']['children']['experius-donations'] = $this->getDonationForm('checkout.donation.list');
        }

        if ($this->donationHelper->isLayoutCheckoutSidebarEnabled() &&
            isset($result['components']['checkout']['children']['sidebar']['children']['summary']['children'])) {
            $result['components']['checkout']['children']['sidebar']['children']['summary']['children']
            ['experius-donations'] = $this->getDonationForm('checkout.sidebar.donation.list');
        }

        return $result;
    }

    /**
     * @param $scope
     * @return array
     */
    public function getDonationForm($nameInLayout)
    {
        $donationProductsBlock = $this->donationProductsFactory->create();
        $donationProductsBlock->setTemplate('donation.phtml');
        $donationProductsBlock->setNameInLayout($nameInLayout);
        $donationProductsBlock->setAjaxRefreshOnSuccess(true);

        $content = $donationProductsBlock->toHtml();
        $content .= "<script type=\"text/javascript\">jQuery('body').trigger('contentUpdated');</script>";

        $donationForm =
            [
                'component' => 'Magento_Ui/js/form/components/html',
                'config' => [
                    'content'=> $content
                ]
            ];

        return $donationForm;
    }
}
