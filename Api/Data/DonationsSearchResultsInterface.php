<?php


namespace Experius\DonationProduct\Api\Data;

interface DonationsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Donations list.
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Experius\DonationProduct\Api\Data\DonationsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
