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

namespace Experius\DonationProduct\Block\Donation;

use Magento\Framework\View\Element\Template\Context;
use Experius\DonationProduct\Helper\Data as DonationHelper;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Checkout\Helper\Cart as CartHelper;
use Magento\Catalog\Block\Product\ImageBuilder;

/**
 * Class ListProduct
 * @package Experius\DonationProduct\Block\Donation
 */
class ListProduct extends \Magento\Framework\View\Element\Template
{
    /**
     * @var DonationHelper
     */
    protected $donationHelper;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var SortOrder
     */
    protected $sortOrder;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CartHelper
     */
    protected $cartHelper;

    /**
     * @var ImageBuilder
     */
    private $imageBuilder;

    /**
     * ListProduct constructor.
     * @param DonationHelper $donationHelper
     * @param ProductRepository $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrder $sortOrder
     * @param Context $context
     * @param CartHelper $cartHelper
     * @param ImageBuilder $imageBuilder
     * @param array $data
     */
    public function __construct(
        DonationHelper $donationHelper,
        ProductRepository $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        Context $context,
        CartHelper $cartHelper,
        ImageBuilder $imageBuilder,
        array $data = []
    ) {

        $this->donationHelper = $donationHelper;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
        $this->cartHelper = $cartHelper;
        $this->imageBuilder = $imageBuilder;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return \Magento\Catalog\Api\Data\ProductInterface[]
     */
    public function getProductCollection()
    {
        $pageSize = $this->donationHelper->getLimitByBlockName($this->_nameInLayout);

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('type_id', 'donation', 'eq')
            ->addFilter('status', 1, 'eq')
            ->setPageSize($pageSize)
            ->setCurrentPage(1)
            ->addSortOrder($this->sortOrder->setDirection('DESC')->setField('name'))
            ->create();

        $products = $this->productRepository->getList($searchCriteria);

        $items = $products->getItems();

        shuffle($items);

        return $items;
    }

    /**
     * @param $product
     * @param array $additional
     * @return string
     */
    public function getAddToCartUrl($product, $additional = [])
    {
        if ($this->isAjaxEnabled()) {
            return $this->getUrl('donation/cart/add', ['product' => $product->getEntityId()]);
        }
        return $this->cartHelper->getAddUrl($product, $additional);
    }


    /**
     * Retrieve product image
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @param array $attributes
     * @return \Magento\Catalog\Block\Product\Image
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        return $this->imageBuilder->setProduct($product)
            ->setImageId($imageId)
            ->setAttributes($attributes)
            ->create();
    }

    /**
     * @return array
     */
    public function getFixedAmounts()
    {
        return $this->donationHelper->getFixedAmounts();
    }

    /**
     * @return mixed
     */
    public function getCurrencySymbol()
    {
        return $this->donationHelper->getCurrencySymbol();
    }
    
    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return str_replace('.', '-', parent::getNameInLayout());
    }

    /**
     * @return string
     */
    public function getMinimalDonationAmount($product)
    {
        return $this->donationHelper->getCurrencySymbol() . ' ' . $this->donationHelper->getMinimalAmount($product);
    }

    /**
     * @return string
     */
    public function getHtmlValidationClasses($product)
    {
        return $this->donationHelper->getHtmlValidationClasses($product);
    }

    /**
     * @return bool
     */
    public function isAjaxEnabled()
    {
        return true;
    }
}
