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

namespace Experius\DonationProduct\Model\Quote\Item;

use Experius\DonationProduct\Helper\Serializer;
use Experius\DonationProduct\Model\DonationOptionsFactory;
use Magento\Quote\Api\Data\ProductOptionExtensionFactory;
use Magento\Quote\Model\Quote\Item\CartItemProcessorInterface;
use Magento\Quote\Api\Data\CartItemInterface;
use Magento\Framework\DataObject\Factory as DataObjectFactory;
use Magento\Quote\Model\Quote\ProductOptionFactory;

/**
 * Class CartItemProcessor
 * @package Experius\DonationProduct\Model\Quote\Item
 */
class CartItemProcessor implements CartItemProcessorInterface
{
    /**
     * @var DataObjectFactory
     */
    private $objectFactory;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var DonationOptionsFactory
     */
    private $donationOptionsFactory;

    /**
     * @var ProductOptionExtensionFactory
     */
    protected $extensionFactory;

    /**
     * @var ProductOptionFactory
     */
    protected $productOptionFactory;

    /**
     * CartItemProcessor constructor.
     * @param DataObjectFactory $objectFactory
     * @param Serializer $serializer
     * @param DonationOptionsFactory $donationOptionsFactory
     * @param ProductOptionFactory $productOptionFactory
     * @param ProductOptionExtensionFactory $extensionFactory
     */
    public function __construct(
        DataObjectFactory $objectFactory,
        Serializer $serializer,
        DonationOptionsFactory $donationOptionsFactory,
        ProductOptionFactory $productOptionFactory,
        ProductOptionExtensionFactory $extensionFactory
    ) {
        $this->objectFactory = $objectFactory;
        $this->donationOptionsFactory = $donationOptionsFactory;
        $this->productOptionFactory = $productOptionFactory;
        $this->extensionFactory = $extensionFactory;
        $this->serializer = $serializer;
    }

    /**
     * @param CartItemInterface $cartItem
     * @return \Magento\Framework\DataObject|null
     */
    public function convertToBuyRequest(CartItemInterface $cartItem)
    {

        if ($cartItem->getProductOption()
            && $cartItem->getProductOption()->getExtensionAttributes()
            && $cartItem->getProductOption()->getExtensionAttributes()->getDonationOptions()
        ) {
            $donationOptions = $cartItem->getProductOption()->getExtensionAttributes()->getDonationOptions();

            if (!empty($donationOptions)) {
                return $this->objectFactory->create($donationOptions->getData());
            }
        }

        return null;
    }

    /**
     * @param CartItemInterface $cartItem
     * @return CartItemInterface
     */
    public function processOptions(CartItemInterface $cartItem)
    {
        $options = $this->getOptions($cartItem);
        if (!empty($options) && is_array($options)) {
            foreach ($options as $name => $value) {
                /** @var \Experius\DonationProduct\Model\DonationOptions $donationOptions */
                $donationOptions = $this->donationOptionsFactory->create();
                $donationOptions->setAmount($value);
            }

            $productOption = $cartItem->getProductOption()
                ? $cartItem->getProductOption()
                : $this->productOptionFactory->create();

            /** @var  \Magento\Quote\Api\Data\ProductOptionExtensionInterface $extensibleAttribute */
            $extensibleAttribute =  $productOption->getExtensionAttributes()
                ? $productOption->getExtensionAttributes()
                : $this->extensionFactory->create();

            $extensibleAttribute->setDonationOptions($donationOptions);
            $productOption->setExtensionAttributes($extensibleAttribute);
            $cartItem->setProductOption($productOption);
        }

        return $cartItem;
    }

    /**
     * @param CartItemInterface $cartItem
     * @return array|mixed|null
     */
    protected function getOptions(CartItemInterface $cartItem)
    {
        $options = !empty($cartItem->getOptionByCode('donation_options'))
            ? $this->serializer->unserialize($cartItem->getOptionByCode('donation_options')->getValue())
            : null;
        return is_array($options)
            ? $options
            : [];
    }
}
