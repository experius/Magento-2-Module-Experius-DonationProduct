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
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package Experius\DonationProduct\Helper
 */
class Data extends AbstractHelper
{

    const DONATION_OPTION_CODE = 'donation_options';

    const DONATION_CONFIGURATION_MINIMAL_AMOUNT = 'experius_donation_product/general/minimal_amount';

    const DONATION_CONFIGURATION_MAXIMAL_AMOUNT = 'experius_donation_product/general/maximal_amount';

    const DONATION_CONFIGURATION_FIXED_AMOUNTS = 'experius_donation_product/general/fixed_amounts';

    const DONATION_CONFIGURATION_PRODUCT_LIMIT_SIDEBAR = 'experius_donation_product/layout/sidebar_product_limit';

    const DONATION_CONFIGURATION_PRODUCT_LIMIT_HOMEPAGE = 'experius_donation_product/layout/homepage_product_limit';

    const DONATION_CONFIGURATION_PRODUCT_LIMIT_CART = 'experius_donation_product/layout/cart_product_limit';

    const DONATION_CONFIGURATION_PRODUCT_LIMIT_CHECKOUT =  'experius_donation_product/layout/checkout_product_limit';

    const DONATION_CONFIGURATION_LAYOUT_CHECKOUT_ENABLED =  'experius_donation_product/layout/checkout_enabled';

    const DONATION_CONFIGURATION_LAYOUT_CHECKOUT_SIDEBAR_ENABLED =
        'experius_donation_product/layout/checkout_sidebar_enabled';

    const DONATION_CONFIGURATION_LAYOUT_SIDEBAR_ENABLED =  'experius_donation_product/layout/sidebar_enabled';

    const DONATION_CONFIGURATION_LAYOUT_HOMEPAGE_ENABLED =  'experius_donation_product/layout/homepage_enabled';

    const DONATION_CONFIGURATION_LAYOUT_CART_ENABLED =  'experius_donation_product/layout/cart_enabled';

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

        $config = $this->scopeConfig->getValue(
            self::DONATION_CONFIGURATION_MINIMAL_AMOUNT,
            ScopeInterface::SCOPE_STORE
        );

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

        $config = $this->scopeConfig->getValue(
            self::DONATION_CONFIGURATION_MAXIMAL_AMOUNT,
            ScopeInterface::SCOPE_STORE
        );

        if ($config) {
            return (int) $config;
        }

        return 10000;
    }

    /**
     * @return array
     */
    public function getFixedAmounts()
    {
        $fixedAmountsConfig = [5,10,15,25,50];

        $config = $this->scopeConfig->getValue(
            self::DONATION_CONFIGURATION_FIXED_AMOUNTS,
            ScopeInterface::SCOPE_STORE
        );

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
     * @return string
     */
    public function getCurrencySymbol()
    {
        return (string) $this->storeManager->getStore()->getCurrentCurrency()->getCurrencySymbol();
    }

    /**
     * @param $blockName
     * @return int
     */
    public function getLimitByBlockName($blockName)
    {
        $limit = $this->scopeConfig->getValue(
            self::DONATION_CONFIGURATION_PRODUCT_LIMIT_CHECKOUT,
            ScopeInterface::SCOPE_STORE
        );

        switch ($blockName) {
            case "sidebar.donation.list":
                $limit = $this->scopeConfig->getValue(
                    self::DONATION_CONFIGURATION_PRODUCT_LIMIT_SIDEBAR,
                    ScopeInterface::SCOPE_STORE
                );
                break;
            case "cms.donation.list":
                $limit = $this->scopeConfig->getValue(
                    self::DONATION_CONFIGURATION_PRODUCT_LIMIT_HOMEPAGE,
                    ScopeInterface::SCOPE_STORE
                );
                break;
            case "cart.donation.list":
                $limit = $this->scopeConfig->getValue(
                    self::DONATION_CONFIGURATION_PRODUCT_LIMIT_CART,
                    ScopeInterface::SCOPE_STORE
                );
                break;
        }

        return (int) $limit;
    }

    /**
     * @return int
     */
    public function isLayoutCheckoutEnabled()
    {
        return (int) $this->scopeConfig->getValue(
            self::DONATION_CONFIGURATION_LAYOUT_CHECKOUT_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return int
     */
    public function isLayoutCheckoutSidebarEnabled()
    {
        return (int) $this->scopeConfig->getValue(
            self::DONATION_CONFIGURATION_LAYOUT_CHECKOUT_SIDEBAR_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param $product
     * @return string
     */
    public function getHtmlValidationClasses($product)
    {
        $range = 'digits-range-' . $this->getMinimalAmount($product) . '-' . $this->getMaximalAmount($product);
        return (string) 'required input-text validate-number validate-digits-range ' . $range;
    }
}
