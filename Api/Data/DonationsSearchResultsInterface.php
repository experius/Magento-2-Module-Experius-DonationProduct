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

namespace Experius\DonationProduct\Api\Data;

/**
 * Interface DonationsSearchResultsInterface
 * @package Experius\DonationProduct\Api\Data
 */
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
