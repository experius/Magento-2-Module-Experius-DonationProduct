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

namespace Experius\DonationProduct\Plugin\Magento\Catalog\Helper\Product;

use Experius\DonationProduct\Helper\Data;

/**
 * Class Configuration
 * @package Experius\DonationProduct\Plugin\Magento\Catalog\Helper\Product
 */
class Configuration
{
    /**
     * @var Data
     */
    protected $donationProductHelper;

    /**
     * Configuration constructor.
     * @param Data $donationProductHelper
     */
    public function __construct(
        Data $donationProductHelper
    ) {
        $this->donationProductHelper = $donationProductHelper;
    }

    /**
     * @param \Magento\Catalog\Helper\Product\Configuration $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Product\Configuration\Item\ItemInterface $item
     * @return array|mixed
     */
    public function aroundGetOptions(
        \Magento\Catalog\Helper\Product\Configuration $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product\Configuration\Item\ItemInterface $item
    ) {

        $product = $item->getProduct();
        $typeId = $product->getTypeId();
        if ($typeId == \Experius\DonationProduct\Model\Product\Type\Donation::TYPE_CODE) {
            $itemOption = $item->getOptionByCode(Data::DONATION_OPTION_CODE);
            $options = [];
            $showOptionsInCart = false;

            if ($itemOption && $showOptionsInCart) {
                $options = $this->donationProductHelper->optionsJsonToMagentoOptionsArray(
                    $itemOption->getValue(),
                    $product
                );
            }

            return array_merge($options, $proceed($item));
        }

        return $proceed($item);
    }
}
