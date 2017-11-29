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

namespace Experius\DonationProduct\Observer\Catalog;

use Experius\DonationProduct\Model\Product\Type\Donation;
use \Magento\CatalogInventory\Api\StockRegistryInterface;

class ProductSaveAfter implements \Magento\Framework\Event\ObserverInterface
{
    private $stockRegistry;

    public function __construct(StockRegistryInterface $stockRegistry)
    {
        $this->stockRegistry = $stockRegistry;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        /* @var $product \Magento\Catalog\Model\Product */
        $product = $observer->getProduct();

        if ($product->getTypeId()== Donation::TYPE_CODE) {
            $stockItem = $this->stockRegistry->getStockItemBySku($product->getSku());

            if ($stockItem->getManageStock()) {
                $stockItem->setManageStock("0");
                $stockItem->setUseConfigManageStock("0");
                $stockItem->setIsInStock("1");
                $this->stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);
            }
        }
    }
}
