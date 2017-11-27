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
use Experius\DonationProduct\Block\Donation\ListProduct as DonationProducts;

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
     * @var DonationProducts
     */
    private $donationProducts;

    /**
     * LayoutProcessor constructor.
     * @param DonationHelper $donationHelper
     * @param DonationProducts $donationProducts
     */
    public function __construct(
        DonationHelper $donationHelper,
        DonationProducts $donationProducts
    ) {
        $this->donationHelper = $donationHelper;
        $this->donationProducts = $donationProducts;
    }

    /**
     * @param array $result
     * @return array
     */
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

    /**
     * @param $scope
     * @return array
     */
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
