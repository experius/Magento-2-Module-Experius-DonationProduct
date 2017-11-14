<?php

namespace Experius\DonationProduct\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
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

    public function isEnabled(){
        return true;
    }
}
