<?php

namespace Experius\DonationProduct\Block\Product\Type;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Experius\DonationProduct\Helper\Data as DonationHelper;

class Donation extends AbstractProduct
{
    protected $donationHelper;

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

    public function getMinimalAmount()
    {
        return $this->donationHelper->getMinimalAmount($this->getProduct());
    }

    public function getConfiguratorCode()
    {
        return $this->donationHelper->getConfiguratorCode($this->getProduct());
    }

    public function getCurrencySymbol()
    {
        return $this->donationHelper->getCurrencySymbol();
    }

    public function getFixedAmounts(){
        return $this->donationHelper->getFixedAmounts();
    }
}
