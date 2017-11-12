<?php


namespace Experius\DonationProduct\Model\ResourceModel\Donations;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Experius\DonationProduct\Model\Donations',
            'Experius\DonationProduct\Model\ResourceModel\Donations'
        );
    }
}
