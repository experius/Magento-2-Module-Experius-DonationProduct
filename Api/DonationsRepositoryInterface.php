<?php


namespace Experius\DonationProduct\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DonationsRepositoryInterface
{


    /**
     * Save Donations
     * @param \Experius\DonationProduct\Api\Data\DonationsInterface $donations
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Experius\DonationProduct\Api\Data\DonationsInterface $donations
    );

    /**
     * Retrieve Donations
     * @param string $donationsId
     * @return \Experius\DonationProduct\Api\Data\DonationsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($donationsId);

    /**
     * Retrieve Donations matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Experius\DonationProduct\Api\Data\DonationsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Donations
     * @param \Experius\DonationProduct\Api\Data\DonationsInterface $donations
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Experius\DonationProduct\Api\Data\DonationsInterface $donations
    );

    /**
     * Delete Donations by ID
     * @param string $donationsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($donationsId);
}
