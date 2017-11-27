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

namespace Experius\DonationProduct\Model\Product;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Customer\Api\GroupManagementInterface;
use Experius\DonationProduct\Helper\Data;

/**
 * Class Price
 * @package Experius\DonationProduct\Model\Product
 */
class Price extends \Magento\Catalog\Model\Product\Type\Price
{

    /**
     * @var
     */
    protected $donationProductHelper;

    /**
     * @var
     */
    protected $eventManager;

    /**
     * Price constructor.
     * @param \Magento\CatalogRule\Model\ResourceModel\RuleFactory $ruleFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param PriceCurrencyInterface $priceCurrency
     * @param GroupManagementInterface $groupManagement
     * @param \Magento\Catalog\Api\Data\ProductTierPriceInterfaceFactory $tierPriceFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     */
    public function __construct(
        \Magento\CatalogRule\Model\ResourceModel\RuleFactory $ruleFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        PriceCurrencyInterface $priceCurrency,
        GroupManagementInterface $groupManagement,
        \Magento\Catalog\Api\Data\ProductTierPriceInterfaceFactory $tierPriceFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $config
    ) {

        parent::__construct(
            $ruleFactory,
            $storeManager,
            $localeDate,
            $customerSession,
            $eventManager,
            $priceCurrency,
            $groupManagement,
            $tierPriceFactory,
            $config
        );
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return mixed
     */
    public function getPrice($product)
    {
        $price = $this->getDonationAmount(1, $product);
        return $price;
    }

    /**
     * @param float|null $qty
     * @param \Magento\Catalog\Model\Product $product
     * @return mixed
     */
    public function getFinalPrice($qty, $product)
    {
        $finalPrice = $this->getDonationAmount($qty, $product);
        $product->setFinalPrice($finalPrice);

        $this->_eventManager->dispatch('catalog_product_get_final_price', ['product' => $product, 'qty' => $qty]);

        $finalPrice = $product->getData('final_price');
        $finalPrice = max(0, $finalPrice);
        $product->setFinalPrice($finalPrice);

        return $finalPrice;
    }


    /**
     * @param \Magento\Catalog\Model\Product $product
     * @param null $qty
     * @return mixed
     */
    public function getBasePrice($product, $qty = null)
    {
        $price =  $this->getDonationAmount($qty, $product);
        return $price;
    }

    /**
     * @param $qty
     * @param $product
     * @return mixed
     */
    public function getDonationAmount($qty, $product)
    {

        $price = $product->getData('price');

        $postData = $product->getCustomOption(data::DONATION_OPTION_CODE);

        if (!$postData) {
            return $price;
        }

        $postData = json_decode($postData->getValue(), true);

        if (isset($postData['amount'])) {
            return $postData['amount'];
        }

        return $price;
    }
}
