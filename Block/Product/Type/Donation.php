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

namespace Experius\DonationProduct\Block\Product\Type;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Experius\DonationProduct\Helper\Data as DonationHelper;

/**
 * Class Donation
 * @package Experius\DonationProduct\Block\Product\Type
 */
class Donation extends AbstractProduct
{
    /**
     * @var DonationHelper
     */
    protected $donationHelper;

    /**
     * Donation constructor.
     * @param Context $context
     * @param DonationHelper $donationHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        DonationHelper $donationHelper,
        array $data = []
    ) {

        $this->donationHelper = $donationHelper;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return int
     */
    public function getMinimalAmount()
    {
        return $this->donationHelper->getMinimalAmount($this->getProduct());
    }

    /**
     * @return int
     */
    public function getMaximalAmount()
    {
        return $this->donationHelper->getMaximalAmount($this->getProduct());
    }

    /**
     * @return mixed
     */
    public function getConfiguratorCode()
    {
        return $this->donationHelper->getConfiguratorCode($this->getProduct());
    }

    /**
     * @return mixed
     */
    public function getCurrencySymbol()
    {
        return $this->donationHelper->getCurrencySymbol();
    }

    /**
     * @return array
     */
    public function getFixedAmounts()
    {
        return $this->donationHelper->getFixedAmounts();
    }

    /**
     * @return string
     */
    public function getMinimalDonationAmount()
    {
        $minimalAmount = $this->donationHelper->getCurrencySymbol() . ' ';
        $minimalAmount .= $this->donationHelper->getMinimalAmount($this->getProduct());

        return $minimalAmount;
    }

    /**
     * @return string
     */
    public function getHtmlValidationClasses()
    {
        return $this->donationHelper->getHtmlValidationClasses($this->getProduct());
    }
}
