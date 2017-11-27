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

namespace Experius\DonationProduct\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Data
 * @package Experius\DonationProduct\Helper
 */
class Data extends AbstractHelper
{

    const DONATION_OPTION_CODE = 'donation_options';

    const DONATION_CONFIGURATION_ENABLED = 'experius_donation_product/general/enabled';

    const DONATION_CONFIGURATION_MINIMAL_AMOUNT = 'experius_donation_product/general/minimal_amount';

    const DONATION_CONFIGURATION_MAXIMAL_AMOUNT = 'experius_donation_product/general/maximal_amount';

    const DONATION_CONFIGURATION_FIXED_AMOUNTS = 'experius_donation_product/general/fixed_amounts';

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Data constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;

        parent::__construct($context);
    }

    /**
     * @param $optionJson
     * @param $product
     * @return array
     */
    public function optionsJsonToMagentoOptionsArray($optionJson, $product)
    {
        $options = [];

        if (!$optionJson) {
            return $options;
        }

        $donationOptions = json_decode($optionJson, true);

        if (is_array($donationOptions)) {
            foreach ($donationOptions as $name => $value) {
                $label = $this->getLabelByName($name);

                $options[] = [
                    'label' => $label,
                    'value' => $value,
                    'print_value' => $label,
                    'option_id' => '',
                    'option_type' => '',
                    'custom_view' => '',
                    'option_value' => $value,
                ];
            }
        }

        return $options;
    }

    /**
     * @param $name
     * @return \Magento\Framework\Phrase
     */
    public function getLabelByName($name)
    {
        if ($name=='amount') {
            return __('Donated Amount');
        }
        return $name;
    }

    /**
     * @param $product
     * @return int
     */
    public function getMinimalAmount($product)
    {
        if ($product->getExperiusDonationMinAmount()) {
            return (int) $product->getExperiusDonationMinAmount();
        }

        $config = $this->scopeConfig->getValue(self::DONATION_CONFIGURATION_MINIMAL_AMOUNT);

        if ($config) {
            return (int) $config;
        }

        return 1;
    }

    /**
     * @param $product
     * @return int
     */
    public function getMaximalAmount($product)
    {
        if ($product->getExperiusDonationMaximalAmount()) {
            return (int) $product->getExperiusDonationMaximalAmount();
        }

        $config = $this->scopeConfig->getValue(self::DONATION_CONFIGURATION_MAXIMAL_AMOUNT);

        if ($config) {
            return (int) $config;
        }

        return 10000;
    }

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(self::DONATION_CONFIGURATION_ENABLED);
    }

    /**
     * @return array
     */
    public function getFixedAmounts()
    {
        $fixedAmountsConfig = [5,10,15,25,50];

        $config = $this->scopeConfig->getValue(self::DONATION_CONFIGURATION_FIXED_AMOUNTS);

        if ($config) {
            $fixedAmountsConfig = explode(',', $config);
        }

        $fixedAmounts = [];
        foreach ($fixedAmountsConfig as $fixedAmount) {
            $fixedAmounts[$fixedAmount] = $this->getCurrencySymbol() . ' ' . $fixedAmount;
        }
        return $fixedAmounts;
    }

    /**
     * @return mixed
     */
    public function getCurrencySymbol()
    {
        return $this->storeManager->getStore()->getCurrentCurrency()->getCurrencySymbol();
    }
}
