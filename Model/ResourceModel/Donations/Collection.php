<?php

namespace Experius\DonationProduct\Model\ResourceModel\Donations;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Experius\DonationProduct\Model\Donations',
            'Experius\DonationProduct\Model\ResourceModel\Donations'
        );
    }
}
