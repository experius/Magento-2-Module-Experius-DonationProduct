<?php

namespace Experius\DonationProduct\Model\Product;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Customer\Api\GroupManagementInterface;
use Experius\DonationProduct\Helper\Data;

class Price extends \Magento\Catalog\Model\Product\Type\Price
{

    protected $donationProductHelper;

    protected $eventManager;

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

    public function getPrice($product)
    {
        $price = $this->getDonationAmount(1, $product);
        return $price;
    }

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


    public function getBasePrice($product, $qty = null)
    {
        $price =  $this->getDonationAmount($qty, $product);
        return $price;
    }

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