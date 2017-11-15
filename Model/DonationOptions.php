<?php


namespace Experius\DonationProduct\Model;

use Experius\DonationProduct\Api\Data\DonationOptionsInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class DonationOptions extends AbstractExtensibleModel implements DonationOptionsInterface
{

    /**
     * Get amount
     * @return string
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * Set amount
     * @param string $amount
     * @return \Experius\DonationProduct\Api\Data\ConfiguratorOptionsInterface
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }
}
