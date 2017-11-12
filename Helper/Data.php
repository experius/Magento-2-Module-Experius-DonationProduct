<?php

namespace Experius\DonationProduct\Helper;

use Braintree\Exception;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const DONATION_OPTION_CODE = 'donation_options';

    const DONATION_CONFIGURATION_MINIMAL_AMOUNT = 'experius_donation_product/general/minimal_amount';

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
                    'print_value' => $label,
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
        if ($product->getExperiusDonationMinimalAmount()) {
            return (int) $product->getExperiusDonationMinimalAmount();
        }

        $config = $this->scopeConfig->getValue(self::DONATION_CONFIGURATION_MINIMAL_AMOUNT);

        if ($config) {
            return (int) $config;
        }

        return 1;
    }

}