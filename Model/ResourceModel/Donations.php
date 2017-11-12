<?php


namespace Experius\DonationProduct\Model\ResourceModel;

class Donations extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('experius_donations', 'donations_id');
    }
}
