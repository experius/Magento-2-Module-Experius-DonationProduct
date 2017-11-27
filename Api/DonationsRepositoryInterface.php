<?php
/**
 * A Magento 2 module named Experius/DonationProduct
 * Copyright (C) 2017 Derrick Heesbeen
 *
 * This file is part of Experius/DonationProduct.
 *
 * Experius/DonationProduct is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Experius\DonationProduct\Api;

/**
 * Interface DonationsRepositoryInterface
 * @package Experius\DonationProduct\Api
 */
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
