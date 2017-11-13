<?php


namespace Experius\DonationProduct\Block\Adminhtml\Charity;

class Index extends \Magento\Framework\View\Element\Template
{

    public function getCharities()
    {
        $apiUrl = $this->_scopeConfig->getValue('experius_donation_product/charities/api_url') . '/en_US' . '/feed.json';
        return json_decode(file_get_contents($apiUrl), true);
    }

}
