<?php

namespace Experius\DonationProduct\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{

    const DONATION_OPTION_CODE = 'donation_options';

    const DONATION_CONFIGURATION_MINIMAL_AMOUNT = 'experius_donation_product/general/minimal_amount';

    private $storeManager;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;

        parent::__construct($context);
    }

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

    public function getLabelByName($name)
    {
        if ($name=='amount') {
            return __('Donation Amount');
        }
        return $name;
    }

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

    public function isEnabled()
    {
        return true;
    }

    public function getFixedAmounts()
    {
        $fixedAmountsConfig = [5,10,15,25,50];

        $fixedAmounts = [];
        foreach ($fixedAmountsConfig as $fixedAmount) {
            $fixedAmounts[$fixedAmount] = $this->getCurrencySymbol() . ' ' . $fixedAmount;
        }
        return $fixedAmounts;
    }

    public function getCurrencySymbol()
    {
        return $this->storeManager->getStore()->getCurrentCurrency()->getCurrencySymbol();
    }
}
